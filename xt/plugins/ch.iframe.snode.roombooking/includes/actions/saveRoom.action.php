<?php

XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable("rbs_rooms") . "
    SET
        title = '" . $GLOBALS['plugin']->getValue("title") . "',
        description = '" . $GLOBALS['plugin']->getValue("description") . "',
        type = '" . $GLOBALS['plugin']->getValue("type") . "',
        seats = '" . $GLOBALS['plugin']->getValue("seats") . "',
        area = '" . $GLOBALS['plugin']->getValue("area") . "',
        image = '" . $GLOBALS['plugin']->getValue("image") . "',
        image_version = '" . $GLOBALS['plugin']->getValue("image_version") . "',
        contact_person = '" . $GLOBALS['plugin']->getValue("contact_person") . "'
    WHERE id = " . $GLOBALS['plugin']->getSessionValue("room_id") . "
",__FILE__,__LINE__);

$GLOBALS['plugin']->setAdminModule("e");

?>
