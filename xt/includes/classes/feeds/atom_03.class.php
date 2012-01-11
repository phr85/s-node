<?php

/**
 * This class implements ATOM version 0.3
 *
 * @author Haydar Ciftci <hciftci@iframe.ch>
 * @version 1.0
 * @package ch.iframe.snode.rssreader
 */
class XT_ATOM_03 extends XT_RSS {
    /**
     * MIME Types for picutures
     *
     * @var array
     * @access private
     */
    var $mime_pics = array('image/jpeg', 'image/gif', 'image/png');

    /**
     * True if last open tag was <author>
     *
     * @var Boolean
     * @access private
     */
    var $insideAuthor = false;

    /**
     * True if last open tag was <link>
     *
     * @var Boolean
     * @access private
     */
    var $insideLink = false;

    /**
     * Contains the attributes of the
     * last open tag
     *
     * @var array
     * @access private
     */
    var $lastOpenTagAttributes = array();

    /**
     * Initializes this class
     *
     * @param string $url Feed URL
     * @return Instance of this class
     * @access public
     */
	function XT_ATOM_03($url) {

	    $this->url = $url;
		$this->loadFeed();
		$this->parser = xml_parser_create($this->getEncoding());
		xml_set_object($this->parser, $this);
		xml_set_element_handler($this->parser, 'openTag', 'closeTag');
		xml_set_character_data_handler($this->parser, 'characterData');
		xml_parse($this->parser, $this->xmldata);
	}

	/**
	 * Handles opening elements
	 *
	 * @param resource $parser The parser object
	 * @param string $tag Opening tag
	 * @param string $attributes The attributes of tag
	 * @return null
	 * @access public
	 */
	function openTag($parser, $tag, $attributes)
	{
		switch (strtoupper($tag)) {
		    case 'FEED':
		      $this->feed['language'] = $attributes['XML:LANG'];
		      $this->insideChannel = false;

	        break;

	        case 'AUTHOR':
	           $this->insideAuthor = true;
            break;

		    case 'LINK':
		      $this->insideLink = true;
		      if($this->insideItem){
              $this->items[$this->currentItemIndex]['link'] = $attributes['HREF'];
		      }
		    break;

			case 'ENTRY':
				$this->insideItem = true;
				$this->insideChannel = true;
				$this->currentItemIndex++;
			break;

			case 'IMAGE':
			    $this->insideImage = true;
			break;
		}

		$this->lastOpenTag = strtoupper($tag);
		$this->lastOpenTagAttributes = $attributes;
	}

	/**
	 * Handles data between the tags
	 *
	 * @param resource $parser The parser object
	 * @param string $cdata The character data
	 * @return null
	 * @access public
	 */
	function characterData($parser, $cdata)
	{
	    $index = strtolower($this->lastOpenTag);
	    $cdata = trim($cdata);
	    switch ($index) {
        	case 'summary':
        		$index = 'description';
            break;

        	case 'created':
        		$index = 'createdate';
            break;

        	case 'issued':
        		$index = 'pubdate';
            break;

        	case 'modified':
        	   if (!$this->insideChannel) {
        	       $index = 'lastbuilddate';
        	   }
        	   else {
        	   	   $index = 'moddate';
        	   }
            break;

            case 'tagline':
        		$index = 'description';
            break;
        }

	    if($this->lastOpenTagAttributes['mode'] == 'base64') {
	    	$cdata = base64_decode($cdata);
	    }


        /*  SYSTEM works with UTF-8, no convertion needed
	    if (function_exists('mb_convert_encoding')) {
	    	$cdata = mb_convert_encoding($cdata, $GLOBALS['meta_charset'], $this->getEncoding());
	    }
	    else {
	    	if ($this->getEncoding() == 'utf-8') {
	    		$cdata = utf8_decode($cdata);
	    	}
	    }
        */

        // wenn feed als iso daherkommt nach utf-8 umwandeln
        if (strtolower($this->getEncoding()) == 'iso-8859-1') {
	    		$cdata = utf8_encode($cdata);
    	}
	    if (!$this->insideChannel) {
	    	if ($this->lastOpenTag == 'LINK') {
	    	 	$this->feed['link'] = $this->lastOpenTagAttributes['HREF'];
	    	}
	    	elseif ($this->insideAuthor && $this->lastOpenTag == 'NAME') {
	    		$this->feed['author'] .= $cdata;
	    	}
	    	elseif ($this->lastOpenTag == 'LINK' && in_array($this->lastOpenTagAttributes['type'], $this->mime_pics)) {
	    		$this->image['url'] = $this->lastOpenTagAttributes['HREF'];
	    	}
	    	else {
	    		$this->feed[$index] .= $cdata;
	    	}
	    }
	    if ($this->insideItem == true && $this->insideChannel == true) {

	    	if ($this->insideAuthor == true && $this->lastOpenTag == 'NAME') {
	    		$this->items[$this->currentItemIndex]['author'] .= trim($cdata);
	    	}
	    	else {
	    		$this->items[$this->currentItemIndex][$index] .= $cdata;

	    	}

	    	if ($this->lastOpenTag == 'LINK') {
	     		$this->items[$this->currentItemIndex][$index] = $this->lastOpenTagAttributes['HREF'];
	    	}
	    }
	}

	/**
	 * Handles closing tags
	 *
	 * @param resource $parser The parser object
	 * @param string $tag The closing tag
	 * @return null
	 * @access public
	 */
	function closeTag($parser, $tag)
	{
		switch (strtoupper($tag)) {
			case 'ENTRY':
				$this->insideItem = false;
			break;

			case 'IMAGE':
			    $this->insideImage = false;
		    break;

		    case 'AUTHOR':
		       $this->items[$this->currentItemIndex]['author'] = trim($this->items[$this->currentItemIndex]['author']);
		       $this->insideAuthor = false;
		    break;

		    case 'LINK':
			    $this->insideLink = false;
		    break;
		}

	}
}
?>