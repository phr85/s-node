<?php

$data = array();

// Parameter :: Gmap id
$gmap_id = XT::getParam("id");

// Parameter :: Gmap key
$data['key'] = XT::getConfig("key");

// Parameter :: Gmap width
$data['width'] = XT::getParam("width") > 0 ? XT::getParam("width") : 300;

// Parameter :: Gmap height
$data['height'] = XT::getParam("height") > 0 ? XT::getParam("height") : 300;

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Get Gmap details
$result = XT::query("
    SELECT
        id,
        title,
        description,
        maplatlong,
        mapzoom,
        markerlatlong
    FROM
        " . XT::getTable('gmap') . "
    WHERE
        id = '" . $gmap_id . "'
    LIMIT 1
",__FILE__,__LINE__);

while($row = $result->FetchRow()){
    $data = array_merge($data,$row);
}

// assign data
XT::assign("xt" . XT::getBaseID() . "_viewer", $data);

// build content
$content = XT::build($style);

if(!XT::getParam("keepassignment")){
    XT::clear_assign("xt" . XT::getBaseID() . "_viewer");
}

?>