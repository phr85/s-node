<?php
 
XT::addImageButton("Save","saveSlide","default","disk_blue.png","0","slave1");
XT::addImageButton("Save and close","saveSlideAndClose","default","save_close.png","0","slave1");



if($GLOBALS['plugin']->getValue("slide_id") != ''){
    $GLOBALS['plugin']->setSessionValue("slide_id", $GLOBALS['plugin']->getValue("slide_id"));
}

// Add slide button
XT::addImageButton("Add slide","addSlide","default","document_new.png","0","slave1");
XT::addImageButton("Add slide","addSlide","slide","document_new.png","0","slave1");

XT::assign("BUTTONS_SLIDE", $GLOBALS['plugin']->getButtons('slide'));

// Get slide details
$result = XT::query("
    SELECT
        id,
        description,
        title,
        random,
        loop,
        active
    FROM
        " . $GLOBALS['plugin']->getTable("autopilot") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("slide_id") . "
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("SLIDESHOW",$data[0]);

// Get slides for active zone
$result = XT::query("
    SELECT
        id,
        page,
        duration,
        comment,
        position,
        active,
        page_type
    FROM
        " . $GLOBALS['plugin']->getTable("autopilot_data") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("slide_id") . "
    ORDER BY
        position ASC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("SLIDES",$data);


$content = XT::build("editSlide.tpl");

?>
