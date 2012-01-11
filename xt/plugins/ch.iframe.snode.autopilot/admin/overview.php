<?php
function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

// Add zone button
XT::addImageButton("Add Slideshow","addSlideshow","default","document_new.png","0","slave1");

$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("autopilot") . "
    ORDER BY id DESC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("SLIDES",$data);
XT::assign("ACTIVE", $GLOBALS['plugin']->getSessionValue("slide_id"));

$content = XT::build("overview.tpl");

?>
