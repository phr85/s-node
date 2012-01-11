<?php
/**
 * This class implements RSS version 2.0
 *
 * @author Haydar Ciftci <hciftci@iframe.ch>
 * @version 1.0
 * @package ch.iframe.snode.rssreader
 */
class XT_RSS_20 extends XT_RSS {
    
    /**
     * Initializes this class
     *
     * @param string $url Feed URL
     * @return Instance of this class
     * @access public
     */
	function XT_RSS_20($url) {
	    $this->url = $url;
		$this->loadFeed();
		
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
		
	}
	
	/**
	 *
	 * @param resource $parser The parser object
	 * @param string $tag The closing tag
	 * @return null
	 * @access public
	 */
	function closeTag($parser, $tag)
	{
		
	}
}
?>