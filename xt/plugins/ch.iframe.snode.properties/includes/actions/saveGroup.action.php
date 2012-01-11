<?php
// Update den Datensatz
XT::loadClass('properties.class.php','ch.iframe.snode.properties');
$properties = new properties($GLOBALS['plugin']->getActiveLang());
$properties->renameGroup (XT::getValue("group_id"),XT::getValue("title"),$GLOBALS['plugin']->getActiveLang(), XT::getValue("description"));

?>