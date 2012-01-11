<?php
// Load properties class
XT::loadClass('properties.class.php','ch.iframe.snode.properties');
$properties = new properties($GLOBALS['plugin']->getActiveLang());
// Create a new property
$id = $properties->addProperty(0,XT::translate("new Property"),0,"");
XT::setValue("property_id",$id);
XT::setAdminModule("pe");
?>