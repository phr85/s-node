<?php

if(XT::getPermission("manageProperties")){
	XT::addImageButton('Add','addProperty','default','add.png','0','slave1');
	
	// get the requested char from the charfilter
	XT::assign("CHAR_FILTER",XT::getValue('char_filter'));

	// Load properties class
	XT::loadClass('properties.class.php','ch.iframe.snode.properties');
	$properties = new properties($GLOBALS['plugin']->getActiveLang());
    $propertiesList = $properties->getPropertiesAttributes();
	XT::assign("DATA", $propertiesList);
    
    // Language selection
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());
	
	if (XT::getValue("lang_filter") != "") {
		XT::assign("FORCE_SLAVE_RELOAD","1");
	}
	
    // Fetch content
    $content = XT::build("properties_overview.tpl");
}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}

?>
