<?php
function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

// Add Google Map button
XT::addImageButton("Add Google Map","addGmap","default","document_new.png","0","slave1");

$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("gmap") . "
    ORDER BY id DESC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("GMAPS",$data);

$content = XT::build("overview.tpl");

?>