<?php

if($GLOBALS['plugin']->getValue("zone_id") != ''){
    $GLOBALS['plugin']->setSessionValue("zone_id", $GLOBALS['plugin']->getValue("zone_id"));
}

// Add zone button
XT::addImageButton("Add banner","addBanner","default","document_new.png","0","slave1");

// Get zone details
$result = XT::query("
    SELECT
        id,
        description,
        title
    FROM
        " . $GLOBALS['plugin']->getTable("banner_zones") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("zone_id") . "
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("ZONE",$data[0]);

// Get banners for active zone
$result = XT::query("
    SELECT
        a.views,
        a.clicks,
        a.clicks/a.views*100 as ctr,
        b.title,
        b.link,
        a.active,
        b.id,
        b.image
    FROM
        " . $GLOBALS['plugin']->getTable("banner_zones_rel") . " as a LEFT JOIN
        " . $GLOBALS['plugin']->getTable("banner") . " as b ON (b.id = a.banner_id)
    WHERE
        a.zone_id = " . $GLOBALS['plugin']->getSessionValue("zone_id") . "
    ORDER BY
        ctr DESC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("BANNERS",$data);

$content = XT::build("banners.tpl");

?>
