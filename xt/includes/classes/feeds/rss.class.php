<?php
/**
 * This class contains basic features
 * required for all rss protocol versions
 *
 * @author Haydar Ciftci <hciftci@iframe.ch>
 * @version 1.0
 * @package ch.iframe.snode.rssreader
 */
class XT_RSS {
    var $feed = array();
    /**
     * Default timeout while fetching feed
     *
     * @var integer
     * @access private
     */
    var $timeout = 5;

    /**
     * The feed location
     *
     * @var string
     * @access private
     */
    var $url = '';

    /**
     * The feed xml content
     *
     * @var string
     * @access private
     */
    var $xmldata = '';
    /**
     * The feed encoding
     *
     * @var string
     * @access public
     */
    var $encoding = 'UTF-8';

    /**
     * XML parser resource
     *
     * @var resource
     * @access private
     */
    var $parser = null;

    /**
     * True if parser is inside an item
     *
     * @var boolean
     * @access private
     */
    var $insideItem = false;

    /**
     * True if parser is inside an image
     *
     * @var boolean
     * @access private
     */
    var $insideImage = false;

    /**
     * The index of the current item
     *
     * @var string
     * @access private
     */
    var $currentItemIndex = 0;

    /**
     *  Title of feed
     *
     * @var string
     * @access private
     */
    var $title = '';

    /**
     * Description of feed
     *
     * @var string
     * @access private
     */
    var $description = '';

    /**
     * Link to homepage
     *
     * @var string
     * @access private
     */
    var $link = '';

    /**
     * Last modification / creation of feed
     *
     * @var string
     * @access private
     */
    var $date = '';

    /**
     * Contains information about feed image
     *
     * @var array
     * @access private
     */
    var $image = array();

    /**
     * Contains all items of feed
     *
     * @var array
     * @access private
     */
    var $items = array();

    /**
     * True if parser is inside channel tag
     *
     * @var boolean
     * @access private
     */
    var $insideChannel = false;

    /**
     * The last opened tag
     *
     * @var string
     * @access private
     */
    var $lastOpenTag = '';

    /**
     * Loads an feed from any location
     *
     * @return boolean Retruns false if loading failed
     * @access public
     */
    function loadFeed()
    {
        $this->xmldata = '';

        $HTTP = new XT_HTTP($this->timeout);
        $HTTP->get($this->url);
        $this->xmldata = $HTTP->data;
    }

   /**
     * Returns the encoding of feed
     *
     * @return string encoding
     * @access public
     */
    function getEncoding()
    {
        preg_match('/encoding=".*"[^>]*\?>/is', $this->xmldata,$patterns);
        preg_match('/encoding=".*"/', $patterns[0],$patterns);

        $encoding = $patterns[0];
        $encoding = str_replace('encoding="', '', $encoding);
        $encoding = str_replace('"', '', $encoding);
        if($encoding){
            $this->encoding = strtolower($encoding);
            return $encoding;
        }else{
            $this->encoding = "utf-8";
            return "utf-8";
        }
    }


    /**
     * Returns the protocol version
     *
     * @return string Protocol version
     * @access public
     */
    function getProtocol($url, $timeout = 5)
    {
        $xmldata = '';
        $protocol = 0;

        $HTTP = new XT_HTTP($timeout);
        $HTTP->get($url);
        $xmldata = $HTTP->data;

        if ($xmldata) {
            if(strpos($xmldata, '<rss version="0.91">') !== false) {
                $protocol = $GLOBALS['plugin']->getConfig('RSS_0.91');
                $found = true;
            }

            if(strpos($xmldata, 'xmlns="http://purl.org/rss/1.0/"') !== false) {
                $protocol = $GLOBALS['plugin']->getConfig('RSS_1.0');
                $found = true;
            }

            if(strpos($xmldata, '<rss version="2.0"') !== false) {
                $protocol = $GLOBALS['plugin']->getConfig('RSS_2.0');
                $found = true;
            }

            if(strpos($xmldata, '<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">') !== false) {
                $protocol = $GLOBALS['plugin']->getConfig('ITUNES_2.0');
                $found = true;
            }

            if(strpos($xmldata, 'xmlns="http://purl.org/atom/ns#"') !== false ) {
                $protocol = $GLOBALS['plugin']->getConfig('ATOM_0.3');
                $found = true;
            }

            if(strpos($xmldata, 'xmlns="http://www.w3.org/2005/Atom"') !== false ) {
                $protocol = $GLOBALS['plugin']->getConfig('ATOM_0.3');
                $found = true;
            }

            if(strpos($xmldata, '<opml xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">') !== false) {
                $protocol = $GLOBALS['plugin']->getConfig('OPML_1.0');
                $found = true;
            }
        }
        return $protocol;
    }
}
?>