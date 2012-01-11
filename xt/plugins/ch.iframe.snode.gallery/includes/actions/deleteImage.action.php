<?php

$GLOBALS['plugin']->call("saveNode");

XT::query("
    UPDATE 
        " . $GLOBALS['plugin']->getTable('galleries_details') . " 
    SET 
        image = '', 
        image_version = ''
    WHERE 
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND 
        node_id = " . XT::getValue('node_id')
,__FILE__,__LINE__,0);

XT::setAdminModule("en");

XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex(XT::getValue("node_id"),$GLOBALS['plugin']->getContentType("Gallery"),XT::getValue('public'));
$search->setImage('');

?>
