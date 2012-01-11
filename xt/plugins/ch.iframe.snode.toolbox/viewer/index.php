<?php
if(XT::getPermission('toolbox')){
	// Configure tabs
	$tabs["info"] = XT::translate("info");
	$tabs["content"] = XT::translate("content");
	$tabs["settings"] = XT::translate("settings");
	// Assign the tabs to the template
	XT::assign("TABS",$tabs);
	
	// Set the tab info by default
	if (XT::getSessionValue("tab") == "") {
		XT::setSessionValue("tab","info");
	}
	// Set the active tab
	if (XT::getValue("tab") != "") {
		XT::setSessionValue("tab",XT::getValue("tab") );
	}
	// Assign the active tab
	XT::assign("ACTIVE_TAB",XT::getSessionValue("tab"));
	
	
	//echo "<pre>" . print_r($this) . "</pre>";
	if (file_exists(PLUGIN_DIR . $this->_params['package'] . '/viewer/' . XT::getSessionValue("tab") . '.php')) {
		include_once PLUGIN_DIR . $this->_params['package'] . '/viewer/' . XT::getSessionValue("tab") . '.php';
	}
	
	XT::assign("SOURCEEDIT_BASEID", 1);
	XT::assign("SOURCEEDIT_TPL", 108);
	
	$content = XT::build(XT::getSessionValue("tab") . '.tpl');
}
?>