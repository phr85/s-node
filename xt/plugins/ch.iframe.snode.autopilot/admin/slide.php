<?php
 
XT::addImageButton("Save","saveSingleSlide","default","disk_blue.png","0","slave1");
XT::addImageButton("Save and close","saveSingleSlideAndClose","default","save_close.png","0","slave1");

// Get slide details
$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("autopilot_data") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("slide_id") . "
    AND
        position = " . $GLOBALS['plugin']->getValue("position") . "
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}
XT::assign('POSITION',$GLOBALS['plugin']->getValue("position"));
XT::assign("SLIDE",$data[0]);
$content = XT::build("editSingleSlide.tpl");
?>
