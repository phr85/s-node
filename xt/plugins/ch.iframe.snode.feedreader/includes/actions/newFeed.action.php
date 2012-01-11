<?php
XT::setAdminModule("e");

include_once(CLASS_DIR . 'http.class.php');

XT::loadClass('feeds/rss.class.php');



// Check if feed allready exists
$result = XT::query("
    SELECT
        COUNT(id) AS cnt
    FROM
        " . XT::getTable("feedreader_feeds") . "
    WHERE
        url='" . XT::getValue("url") . "'
",__FILE__,__LINE__);

$row = $result->fetchRow();

if ($row['cnt'] > 0) {
    XT::log("This feed allready exists", __FILE__, __LINE__, XT_WARNING);

    $result = XT::query("
	   SELECT
	       id
       FROM
           " . XT::getTable("feedreader_feeds") . "
       WHERE
           url='" . XT::getValue("url") . "'
	",__FILE__,__LINE__);

    $row =  $result->fetchRow();
    XT::setValue("feed_id", $row['id']);
}
else {
    $protocol = trim(XT_RSS::getProtocol(XT::getValue("url")));
    switch ($protocol) {
        case 'rss_091':
        XT::loadClass('feeds/rss_parser.class.php');
        $feed = new XT_RSS_PARSER(XT::getValue("url"));
        $feed->loadFeed();
        break;
        case 'rss_20':
        XT::loadClass('feeds/rss_parser.class.php');
        $feed = new XT_RSS_PARSER(XT::getValue("url"));
        $feed->loadFeed();
        break;

        case 'itunes_20':
        XT::loadClass('feeds/itunes20_parser.class.php');
        $feed = new XT_RSS_PARSER(XT::getValue("url"));
        $feed->loadFeed();
        break;

        case 'atom_03':
        XT::loadClass('feeds/rss_parser.class.php');
        $feed = new XT_RSS_PARSER(XT::getValue("url"));
        $feed->loadFeed();
        break;

        default:
        XT::log($protocol . " not supported" ,__FILE__,__LINE__,XT_ERROR);
        break;
    }
}


XT::query("INSERT INTO " . XT::getTable("feedreader_feeds") . "
(id,
title,
url,
creation_date,
creation_user,
mod_date,
mod_user,
refresh_interval,
last_update,
protocol,
encoding,
active,
generator,
language,
copyright,
docs,
description,
managingeditor,
image_url,
image_link,
image_title,
image_width,
image_height
) VALUES (
NULL,
'" . addslashes($feed->feed['title']) . "',
'" . XT::getValue("url") . "',
" . time() . ",
" . XT::getUserID() . ",
NULL,
NULL,
30,
0,
'" . $protocol . "',
'" . $feed->encoding . "',
1,
'" . addslashes($feed->feed['generator']) . "',
'" . addslashes($feed->feed['language']) . "',
'" . addslashes($feed->feed['copyright']) . "',
'" . addslashes($feed->feed['docs']) . "',
'" . addslashes($feed->feed['description']) . "',
'" . addslashes($feed->feed['managingeditor']) . "',
'" . addslashes($feed->image['url']) . "',
'" . addslashes($feed->image['link']) . "',
'" . addslashes($feed->image['title']) . "',
'" . $feed->image['width'] . "',
'" . $feed->image['height'] . "'
)",__FILE__,__LINE__,0);


$result = XT::query("
	   SELECT
	       id
       FROM
           " . XT::getTable("feedreader_feeds") . "
       WHERE
           url='" . XT::getValue("url") . "'
	",__FILE__,__LINE__);

    $row =  $result->fetchRow();
    XT::setValue("feed_id", $row['id']);



?>