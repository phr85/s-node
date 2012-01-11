<?php
include_once(CLASS_DIR . 'feed.class.php');
$feed_dir = 'ch.iframe.snode.newsmanager/includes/feeds/latest/';

/**
 * category
 * pics_only
 * count
 */
$query = "category=0&pics_only=0&count=0";
$md5 = md5($query);
$feeder = new XT_Feed(PLUGIN_DIR . $feed_dir . $md5 . '/');
$update = false;

if (!is_dir(PLUGIN_DIR . $feed_dir . $md5)) {
	mkdir(PLUGIN_DIR . $feed_dir . $md5);
	$update = true;
}
else {
	if (is_file(PLUGIN_DIR . $feed_dir . $md5 . '/.update')) {
		$update = true;
	}
}

if ($update) {
        
        // Image url
    	$result = XT::query("
    	   SELECT
    	       open_url
	       FROM
	           " . XT::getDatabasePrefix() . "content_types
           WHERE
                title = 'Image'"
    	,__FILE__,__LINE__);
    	
    	$row = $result->fetchRow();
    	$img_src = $row["open_url"];
    	
    	$image_id = $imageData['id'];
    	
    	$imageData['url'] = htmlspecialchars('http://' . $_SERVER['HTTP_HOST']) . str_replace('%id%', $image_id, $img_src);
    	$imageData['link'] = htmlspecialchars('http://' . $_SERVER['HTTP_HOST']);
    	
    	$feedData['link'] = htmlspecialchars('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    	$feedData['generator'] = $creator;
    	$feedData['tagline'] = $tagline;
    	$feedData['description'] = $description;
    	$feedData['title'] = $title;
    	$feedData['lang'] = $GLOBALS['plugin']->getActiveLang();
    	$feedData['pubDate'] = date('D, d M Y H:i:s T');
    	
    	// Content type open url
    	$result = XT::query("
    	   SELECT
    	       open_url
	       FROM
	           " . XT::getDatabasePrefix() . "content_types
           WHERE
                id = " . $content_type
    	,__FILE__,__LINE__);
    	
    	$row = $result->fetchRow();
    	$open_url = $row["open_url"];
    	
    	// Get entries
    	$result = XT::query("
    	   SELECT
    	       id,
    	       title,
    	       autor as managingEditor,
    	       introduction as description,
    	       lang
           FROM 
               " . XT::getDatabasePrefix() . "newsmanager
           WHERE 
               active = 1 AND
               exclude_from_feed = 0 AND
               lang='" . $GLOBALS['plugin']->getActiveLang() . "'
           LIMIT
                15
    	", __FILE__, __LINE__);
    	
    	$Items = array();
    	$i = 0;
    	
    	
    	
    	while ($row = $result->fetchRow()) {
    	    $Items[$i] = array();
    	    $link = 'http://' . $_SERVER['HTTP_HOST'] . str_replace('%id%', $row['id'], $open_url);
    		$Items[$i]['title'] = strip_tags($row['title']);
    		$Items[$i]['managingEditor'] = strip_tags($row['managingEditor']);
    		$Items[$i]['description'] = strip_tags($row['description']);
    		$Items[$i]['link'] = htmlspecialchars($link);
    		$Items[$i]['lang'] = $row['lang'];
    		$i++;
    	}
    	$feeder->generate($feedData, $imageData, $Items);
}

$feeder->output($protocol);

?>