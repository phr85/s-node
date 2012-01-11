<?php
XT::query("
    UPDATE
        " . XT::getTable("autopilot") . "
    SET
        title = '" . XT::getValue("title") . "',
        description = '" . XT::getValue("description") . "',
        loop = '" . XT::getValue("loop") . "',
        random = '" . XT::getValue("random") . "'
    WHERE id = " . XT::getSessionValue("slide_id") . "
",__FILE__,__LINE__);

XT::setAdminModule("e");

// Instantiate indexing object and index main fields
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex($GLOBALS['plugin']->getSessionValue('slide_id')
,$GLOBALS['plugin']->getContentType("Slideshow"),0);
$search->build($GLOBALS['plugin']->getValue('title'), $GLOBALS['plugin']->getValue('description'));


?>