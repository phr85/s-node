<?php

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Parameter :: List all banners of a zone at once
$allbanner = XT::getParam('allbanner') == 'yes' ? true : false;
XT::assign("ALLBANNER",$allbanner);

// Parameter :: Page cannot be the same
$ignore_same_tpl = XT::getParam('ignore_same_tpl') != '' ? XT::getParam('ignore_same_tpl') : 0;

$addon = '';
if($ignore_same_tpl == 1){
    $addon = "AND b.link != '" . $GLOBALS['tpl_id'] . "'";
}
if ($_REQUEST["zonename"] != "") {
	$result = XT::query("SELECT * FROM " . $GLOBALS['plugin']->getTable("banner_zones") . " WHERE title = '" . $_REQUEST["zonename"]  . "';",__FILE__,__LINE__);
	$row = $result->FetchRow();
	$zoneid = $row['id'];
} else {
	$zoneid = XT::getParam("zone");
}

// Set the order to the title if all banners are displayed. At the moment you can't sort banners in a zone unless you set a title
// like 1.Banner, 2.Banner and so forth...
if ($allbanner) {
	$orderby = "b.title ASC";
} else {
	$orderby = "RAND()";
}

$result = XT::query("
SELECT
    b.id,
    b.title,
    b.link,
    b.link_type,
    b.target,
    b.image,
    b.code,
    b.type,
	d.width,
	d.height,
    rel.zone_id,
    d.type as image_type,
    b.width as bannerwidth,
    b.height as bannerheight,
    b.description
FROM
    " . $GLOBALS['plugin']->getTable("banner_zones_rel") . " as rel LEFT JOIN
    " . $GLOBALS['plugin']->getTable("banner") . " as b ON (b.id = rel.banner_id) LEFT JOIN
    " . $GLOBALS['plugin']->getTable("files") . " as d ON (d.id = b.image)
WHERE
    rel.zone_id = '" . $zoneid. "'
    AND
        rel.active = 1
    AND
        (b.display_time_start = 0 OR b.display_time_start < " . time() . ")
    AND
        (b.display_time_end = 0 OR b.display_time_end > " . time() . ")
    " . $addon . "
    ORDER BY
        " . $orderby . "

",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $row['link'] = urlencode($row['link']);
    $data[] = $row;
    $zoneid = $row['zone_id'];
}

XT::assign("BANNERS",$data);
XT::assign("ZONE",$data);

if (XT::getConfig("log_actions") == true){
	// Count view
	XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable("views") . " (zone_id,session_id,call_date,referer)
	    VALUES (
	        '" . $zoneid  . "',
	        '" . session_id() . "',
	        '" . time() . "',
	        '" . $_SERVER['HTTP_REFERER'] . "'
	    )
	",__FILE__,__LINE__);
}

XT::query("UPDATE
    " . $GLOBALS['plugin']->getTable("banner_zones_rel") . "
    SET views = views+1
    WHERE banner_id = '" . $data[0]['id'] . "'
    AND zone_id = '" . $zoneid  . "'
");

XT::assign("VERSION", "" . XT::getParam("version"));

$content = XT::build($style);

?>