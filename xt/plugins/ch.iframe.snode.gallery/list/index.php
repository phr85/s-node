<?php

// Parameter :: style (string  => default is default.tpl)
$style = XT::getParam("style") !='' ? XT::getParam("style") : "default.tpl";

$category = XT::autoval("category","R",1);

// Parameter :: gallery_tpl (int)
$gallery_tpl = XT::getParam("gallery_tpl") !='' ? XT::getParam("gallery_tpl") : 1;

// order
if(XT::getParam('order')!=""){
    $order_by = "b." . XT::getParam('order');
}else {
    $order_by = "a.l ASC";
}

// Parameter :: Count
$limit = $GLOBALS['plugin']->getParam('limit') != '' ? $GLOBALS['plugin']->getParam('limit') : '15';



// Get galleries for this category
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable('galleries') . " as a LEFT JOIN
        " . XT::getTable('galleries_details') . " as b ON (b.node_id = a.id AND b.lang='" . XT::getLang() . "' AND b.active=1)
    WHERE
        a.pid = " . $category . "
      ORDER BY " . $order_by . "
      LIMIT " .  $limit
,__FILE__,__LINE__);

$galleries = array();
while($row = $result->FetchRow()){
    $galleries[] = $row;
}
$data = array();
$data['galleries'] = @$galleries;
$data["gallery_tpl"] = $gallery_tpl;
XT::assign("DATA",$data);

$content = XT::build($style);

?>