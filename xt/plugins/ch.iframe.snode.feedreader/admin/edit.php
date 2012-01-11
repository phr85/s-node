<?php
include_once(CLASS_DIR . 'http.class.php');
include_once(CLASS_DIR . 'feeds/rss.class.php');

if(XT::getPermission('editfeeds')){
    $GLOBALS['plugin']->contribute("edit_buttons", "Save", "saveFeed","disk_blue.png","0");
}

$result = XT::query("
	   SELECT
	       *
       FROM
           " . XT::getTable("feedreader_feeds") . "
       WHERE
           id='" . XT::getValue("feed_id") . "'
	",__FILE__,__LINE__);
$feed = XT::getQueryData($result);
XT::assign('FEED',$feed[0]);

$content = XT::build("edit.tpl");
?>