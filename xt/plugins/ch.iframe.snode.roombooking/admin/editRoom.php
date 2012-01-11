<?php


XT::addImageButton("[S]ave","saveRoom","default","disk_blue.png","0","slave1","s");
XT::addImageButton("Save and close","saveRoomAndClose","default","save_close.png","0","slave1","e");

XT::addImageButton("[a]dd booking","addRes2Room","default","calendar.png","0","slave1","a");



if($GLOBALS['plugin']->getValue("room_id") != ''){
    $GLOBALS['plugin']->setSessionValue("room_id", $GLOBALS['plugin']->getValue("room_id"));
}
 

// Get room details
$result = XT::query("
    SELECT * FROM
        " . $GLOBALS['plugin']->getTable("rbs_rooms") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("room_id") . "
",__FILE__,__LINE__);

$data = array();
$data = XT::getQueryData($result);

XT::assign("ROOM",$data[0]);


$contact_person_id = is_numeric($data[0]['contact_person']) ? $data[0]['contact_person'] : 0;
$result = XT::query("
    SELECT
        id,
        title,
        street,
        postalCode,
        city
    FROM
        " . XT::getTable("addresses") . "
    WHERE
        id=" . $contact_person_id
,__FILE__,__LINE__);

XT::assign("CONTACT_PERSON", $result->fetchRow());
XT::assign("ADDR_PICKER_TPL", XT::getConfig("ADDR_PICKER_TPL"));

$content = XT::build("editRoom.tpl");

?>
