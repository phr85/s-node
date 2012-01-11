<?php
// Load properties class
XT::loadClass('properties.class.php','ch.iframe.snode.properties');
$properties = new properties($GLOBALS['plugin']->getActiveLang());
// Create a new property
$id = $properties->addGroup(XT::translate("new Group"),"");
XT::setValue("group_id",$id);
XT::setAdminModule("ge");
?>