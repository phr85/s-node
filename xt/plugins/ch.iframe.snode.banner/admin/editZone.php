<?php

 
XT::addImageButton("Save","saveZone","default","disk_blue.png","0","slave1");
XT::addImageButton("Save and close","saveZoneAndClose","default","save_close.png","0","slave1");



if($GLOBALS['plugin']->getValue("zone_id") != ''){
    $GLOBALS['plugin']->setSessionValue("zone_id", $GLOBALS['plugin']->getValue("zone_id"));
}

// Add zone button
XT::addImageButton("Add banner","addBanner","default","document_new.png","0","slave1");
XT::addImageButton("Add banner","addBanner","banner","document_new.png","0","slave1");

XT::assign("BUTTONS_BANNER", $GLOBALS['plugin']->getButtons('banner'));

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
        b.image,
        d.type as image_type,
        d.width,
        d.height,
        b.display_time_start,
        b.display_time_end
    FROM
        " . $GLOBALS['plugin']->getTable("banner_zones_rel") . " as a LEFT JOIN
        " . $GLOBALS['plugin']->getTable("banner") . " as b ON (b.id = a.banner_id) LEFT JOIN 
        " . $GLOBALS['plugin']->getTable("files") . " as d ON (d.id = b.image)
    WHERE
        a.zone_id = " . $GLOBALS['plugin']->getSessionValue("zone_id") . "
    ORDER BY
        ctr DESC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    if(($row['display_time_start'] < TIME && $row['display_time_end'] > TIME) || ($row['display_time_start'] < TIME && $row['display_time_end'] == 0) || ($row['display_time_start'] ==0  && $row['display_time_end'] > TIME) ){
        $row['timer'] = 'running';
    }else {
        $row['timer'] = 'ready';
    }
    if ($row['display_time_end'] < TIME && $row['display_time_end'] != 0)   {
        $row['timer'] = 'expired';
    }
    if ($row['display_time_start'] == 0 && $row['display_time_end'] == 0)   {
        $row['timer'] = 'unused';
    }
    
    $data[] = $row;
}

XT::assign("BANNERS",$data);


$content = XT::build("editZone.tpl");

?>
