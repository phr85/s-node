<?php

XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable("banner_zones") . "
    SET
        title = '" . $GLOBALS['plugin']->getValue("title") . "',
        description = '" . $GLOBALS['plugin']->getValue("description") . "',
        type = '" . $GLOBALS['plugin']->getValue("type") . "',
        width = '" . $GLOBALS['plugin']->getValue("width") . "',
        height = '" . $GLOBALS['plugin']->getValue("height") . "'
    WHERE id = " . $GLOBALS['plugin']->getSessionValue("zone_id") . "
",__FILE__,__LINE__);

$GLOBALS['plugin']->setAdminModule("e");

?>
