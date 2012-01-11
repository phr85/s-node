<?php

XT::query("UPDATE " . XT::getTable("forms") .  "
    SET
        title = '" . XT::getValue("title") . "',
        layout = '" . XT::getValue("layout") . "',
        description = '" . XT::getValue("description") . "',
        identifier = '" . XT::getValue("identifier") . "',
		hide_label = '" . XT::getValue("hide_label") . "'
    WHERE
        id = " . XT::getSessionValue("form_id") . "
    ",__FILE__,__LINE__);

XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex(XT::getSessionValue("form_id"),$GLOBALS['plugin']->getContentType("Form"),1);
$search->build(XT::getValue("title"), XT::getValue("description"));

XT::setAdminModule("ef");

?>
