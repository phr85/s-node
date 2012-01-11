<?php

include_once(CLASS_DIR . 'feeds/rss.class.php');

/**
 * This class implements RSS version 0.91 and 2.0
 *
 * @author Haydar Ciftci <hciftci@iframe.ch>
 * @version 1.0
 * @package ch.iframe.snode.rssreader
 */
class XT_RSS_PARSER extends XT_RSS {
    /**
     * Initializes this class
     *
     * @param string $url Feed URL
     * @return Instance of this class
     * @access public
     */
    function XT_RSS_PARSER($url) {
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

        if ($this->insideChannel && $tag == 'LOGO') {
            $this->insideImage = true;
        }

        switch ($tag) {
            case 'CHANNEL':
            $this->insideChannel = true;
            $this->insideItem = false;
            break;

            case 'ITEM':
            $this->insideItem = true;
            $this->insideChannel = false;
            $this->currentItemIndex++;
            break;

            case 'ENCLOSURE':
            if (sizeof($attributes)) {
                while (list($k, $v) = each($attributes)) {
                    $this->items_attributes[$this->currentItemIndex]['enclosure'][strtolower($k)]=$v;
                }
            }
            break;

            case 'IMAGE':
            $this->insideImage = true;
            break;

        }
        $this->lastOpenTag = $tag;
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

        /*  SYSTEM works with UTF-8, no convertion needed
        if (function_exists('mb_convert_encoding')) {
            $cdata = mb_convert_encoding($cdata, $GLOBALS['meta_charset'], $this->getEncoding());
        }
        else {
            if (strtolower($this->getEncoding()) == 'utf-8') {
                $cdata = utf8_decode($cdata);
            }
        }
        */
          // wenn feed als iso daherkommt nach utf-8 umwandeln
        if (strtolower($this->getEncoding()) == 'iso-8859-1') {
	    		$cdata = utf8_encode($cdata);
    	}

        if (!$this->insideItem) {

            if ($this->insideImage) {
                if ($this->lastOpenTag == 'LOGO') {
                    $this->image['url'] .= $cdata;
                }
                else {
                    $this->image[$index] .= $cdata;
                }
            }
            else {
                $this->feed[$index] .= $cdata;
            }

        }
        elseif($this->insideItem) {

            if ($this->lastOpenTag != 'ITEM') {

                if ($this->insideImage) {
                    $this->items[$this->currentItemIndex]['image'][$index] .= $cdata;
                }
                else {
                    $this->items[$this->currentItemIndex][$index] .= $cdata;
                }

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
        if ($this->insideChannel && $tag == 'LOGO') {
            $this->insideImage = false;
        }

        switch ($tag) {
            case 'ITEM':
            $this->insideItem = false;
            break;

            case 'CHANNEL':
            $this->insideChannel = false;
            break;

            case 'IMAGE':
            $this->insideImage = false;
            break;
        }
    }

}
?>