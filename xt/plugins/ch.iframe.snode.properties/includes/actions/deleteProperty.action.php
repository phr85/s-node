<?php
// Load properties class
XT::loadClass('properties.class.php','ch.iframe.snode.properties');
$properties = new properties($GLOBALS['plugin']->getActiveLang());
// Create a new property
$id = $properties->delProperty(XT::getValue("property_id"));

?>