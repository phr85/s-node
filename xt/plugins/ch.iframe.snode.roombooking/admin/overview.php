<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

// Add room button
XT::addImageButton("Add room","addRoom","default","document_new.png","0","slave1");

$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("rbs_rooms") . "
    ORDER BY id DESC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("ROOMS",$data);
XT::assign("ACTIVE", $GLOBALS['plugin']->getSessionValue("room_id"));

$content = XT::build("overview.tpl");

?>
