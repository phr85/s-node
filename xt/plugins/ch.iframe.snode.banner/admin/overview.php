<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

// Add zone button
XT::addImageButton("Add zone","addZone","default","document_new.png","0","slave1");

$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("banner_zones") . "
    ORDER BY id DESC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("ZONES",$data);
XT::assign("ACTIVE", $GLOBALS['plugin']->getSessionValue("zone_id"));

$content = XT::build("overview.tpl");

?>
