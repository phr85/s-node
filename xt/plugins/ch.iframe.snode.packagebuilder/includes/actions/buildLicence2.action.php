<?php
// get submited values
$values = XT::getValue('value');
// create the configuration array for the selected product
switch($values['product']){
	// Syntaxt $packages[packagename] = limit (0 = no limit)
	case "enterprise":
		$packages["ch.iframe.snode.gmap"] = "0";
		$packages["ch.iframe.snode.virtual"] = "0";
		$packages["ch.iframe.snode.toolbox"] = "0";
		$packages["ch.iframe.snode.usermanager"] = "0";
		$packages["ch.iframe.snode.units"] = "0";
		$packages["ch.iframe.snode.translations"] = "0";
		$packages["ch.iframe.snode.thememanager"] = "0";
		$packages["ch.iframe.snode.starter"] = "0";
		$packages["ch.iframe.snode.settings"] = "0";
		$packages["ch.iframe.snode.securitycenter"] = "0";
		$packages["ch.iframe.snode.search"] = "0";
		$packages["ch.iframe.snode.relations"] = "0";
		$packages["ch.iframe.snode.permissions"] = "0";
		$packages["ch.iframe.snode.objects"] = "0";
		$packages["ch.iframe.snode.nodepermissions"] = "0";
		$packages["ch.iframe.snode.navigation"] = "0";
		$packages["ch.iframe.snode.messages"] = "0";
		$packages["ch.iframe.snode.installer"] = "0";
		$packages["ch.iframe.snode.info"] = "0";
		$packages["ch.iframe.snode.history"] = "0";
		$packages["ch.iframe.snode.header"] = "0";
		$packages["ch.iframe.snode.guestbook"] = "0";
		$packages["ch.iframe.snode.formmanager"] = "0";
		$packages["ch.iframe.snode.footer"] = "0";
		$packages["ch.iframe.snode.filloutsviewer"] = "0";
		$packages["ch.iframe.snode.filemanager"] = "0";
		$packages["ch.iframe.snode.feedreader"] = "0";
		$packages["ch.iframe.snode.errorpages"] = "0";
		$packages["ch.iframe.snode.css"] = "0";
		$packages["ch.iframe.snode.core"] = "0";
		$packages["ch.iframe.snode.category"] = "0";
		$packages["ch.iframe.snode.banner"] = "0";
		$packages["ch.iframe.snode.autopilot"] = "0";
		$packages["ch.iframe.snode.articles"] = "0";
		$packages["ch.iframe.snode.addressmanager"] = "0";
	break;
	
	case "standard":
		$packages["ch.iframe.snode.gmap"] = "0";
		$packages["ch.iframe.snode.virtual"] = "0";
		$packages["ch.iframe.snode.toolbox"] = "0";
		$packages["ch.iframe.snode.usermanager"] = "0";
		$packages["ch.iframe.snode.units"] = "0";
		$packages["ch.iframe.snode.translations"] = "0";
		$packages["ch.iframe.snode.thememanager"] = "0";
		$packages["ch.iframe.snode.starter"] = "0";
		$packages["ch.iframe.snode.settings"] = "0";
		$packages["ch.iframe.snode.securitycenter"] = "0";
		$packages["ch.iframe.snode.search"] = "0";
		$packages["ch.iframe.snode.relations"] = "0";
		$packages["ch.iframe.snode.permissions"] = "0";
		$packages["ch.iframe.snode.objects"] = "0";
		$packages["ch.iframe.snode.nodepermissions"] = "0";
		$packages["ch.iframe.snode.navigation"] = "0";
		$packages["ch.iframe.snode.messages"] = "0";
		$packages["ch.iframe.snode.installer"] = "0";
		$packages["ch.iframe.snode.info"] = "0";
		$packages["ch.iframe.snode.history"] = "0";
		$packages["ch.iframe.snode.header"] = "0";
		$packages["ch.iframe.snode.guestbook"] = "0";
		$packages["ch.iframe.snode.formmanager"] = "0";
		$packages["ch.iframe.snode.footer"] = "0";
		$packages["ch.iframe.snode.filloutsviewer"] = "0";
		$packages["ch.iframe.snode.filemanager"] = "0";
		$packages["ch.iframe.snode.feedreader"] = "0";
		$packages["ch.iframe.snode.errorpages"] = "0";
		$packages["ch.iframe.snode.css"] = "0";
		$packages["ch.iframe.snode.core"] = "0";
		$packages["ch.iframe.snode.category"] = "0";
		$packages["ch.iframe.snode.banner"] = "0";
		$packages["ch.iframe.snode.autopilot"] = "0";
		$packages["ch.iframe.snode.articles"] = "0";
		$packages["ch.iframe.snode.addressmanager"] = "0";
	break;
	
	case "medium":
		$packages["ch.iframe.snode.gmap"] = "0";
		$packages["ch.iframe.snode.virtual"] = "0";
		$packages["ch.iframe.snode.toolbox"] = "0";
		$packages["ch.iframe.snode.usermanager"] = "0";
		$packages["ch.iframe.snode.units"] = "0";
		$packages["ch.iframe.snode.translations"] = "0";
		$packages["ch.iframe.snode.thememanager"] = "0";
		$packages["ch.iframe.snode.starter"] = "0";
		$packages["ch.iframe.snode.settings"] = "0";
		$packages["ch.iframe.snode.securitycenter"] = "0";
		$packages["ch.iframe.snode.search"] = "0";
		$packages["ch.iframe.snode.relations"] = "0";
		$packages["ch.iframe.snode.permissions"] = "0";
		$packages["ch.iframe.snode.objects"] = "0";
		$packages["ch.iframe.snode.nodepermissions"] = "0";
		$packages["ch.iframe.snode.navigation"] = "100";
		$packages["ch.iframe.snode.messages"] = "0";
		$packages["ch.iframe.snode.installer"] = "0";
		$packages["ch.iframe.snode.info"] = "0";
		$packages["ch.iframe.snode.history"] = "0";
		$packages["ch.iframe.snode.header"] = "0";
		$packages["ch.iframe.snode.guestbook"] = "0";
		$packages["ch.iframe.snode.formmanager"] = "5";
		$packages["ch.iframe.snode.footer"] = "0";
		$packages["ch.iframe.snode.filemanager"] = "0";
		$packages["ch.iframe.snode.feedreader"] = "0";
		$packages["ch.iframe.snode.errorpages"] = "0";
		$packages["ch.iframe.snode.css"] = "0";
		$packages["ch.iframe.snode.core"] = "0";
		$packages["ch.iframe.snode.category"] = "0";
		$packages["ch.iframe.snode.banner"] = "0";
		$packages["ch.iframe.snode.autopilot"] = "0";
		$packages["ch.iframe.snode.articles"] = "0";
		$packages["ch.iframe.snode.addressmanager"] = "0";
	break;
	
	case "beginner":
		$packages["ch.iframe.snode.gmap"] = "0";
		$packages["ch.iframe.snode.virtual"] = "0";
		$packages["ch.iframe.snode.toolbox"] = "0";
		$packages["ch.iframe.snode.usermanager"] = "0";
		$packages["ch.iframe.snode.units"] = "0";
		$packages["ch.iframe.snode.translations"] = "0";
		$packages["ch.iframe.snode.thememanager"] = "0";
		$packages["ch.iframe.snode.starter"] = "0";
		$packages["ch.iframe.snode.settings"] = "0";
		$packages["ch.iframe.snode.search"] = "0";
		$packages["ch.iframe.snode.relations"] = "0";
		$packages["ch.iframe.snode.objects"] = "0";
		$packages["ch.iframe.snode.navigation"] = "50";
		$packages["ch.iframe.snode.messages"] = "0";
		$packages["ch.iframe.snode.installer"] = "0";
		$packages["ch.iframe.snode.info"] = "0";
		$packages["ch.iframe.snode.history"] = "0";
		$packages["ch.iframe.snode.header"] = "0";
		$packages["ch.iframe.snode.guestbook"] = "0";
		$packages["ch.iframe.snode.formmanager"] = "3";
		$packages["ch.iframe.snode.footer"] = "0";
		$packages["ch.iframe.snode.filemanager"] = "0";
		$packages["ch.iframe.snode.feedreader"] = "0";
		$packages["ch.iframe.snode.errorpages"] = "0";
		$packages["ch.iframe.snode.css"] = "0";
		$packages["ch.iframe.snode.core"] = "0";
		$packages["ch.iframe.snode.category"] = "0";
		$packages["ch.iframe.snode.banner"] = "0";
		$packages["ch.iframe.snode.articles"] = "0";
	break;
	
	case "micro":
		$packages["ch.iframe.snode.gmap"] = "0";
		$packages["ch.iframe.snode.virtual"] = "0";
		$packages["ch.iframe.snode.toolbox"] = "0";
		$packages["ch.iframe.snode.usermanager"] = "0";
		$packages["ch.iframe.snode.translations"] = "0";
		$packages["ch.iframe.snode.units"] = "0";
		$packages["ch.iframe.snode.thememanager"] = "0";
		$packages["ch.iframe.snode.starter"] = "0";
		$packages["ch.iframe.snode.settings"] = "0";
		$packages["ch.iframe.snode.search"] = "0";
		$packages["ch.iframe.snode.relations"] = "0";
		$packages["ch.iframe.snode.objects"] = "0";
		$packages["ch.iframe.snode.navigation"] = "50";
		$packages["ch.iframe.snode.messages"] = "0";
		$packages["ch.iframe.snode.installer"] = "0";
		$packages["ch.iframe.snode.info"] = "0";
		$packages["ch.iframe.snode.history"] = "0";
		$packages["ch.iframe.snode.header"] = "0";
		$packages["ch.iframe.snode.guestbook"] = "0";
		$packages["ch.iframe.snode.formmanager"] = "3";
		$packages["ch.iframe.snode.footer"] = "0";
		$packages["ch.iframe.snode.filemanager"] = "0";
		$packages["ch.iframe.snode.feedreader"] = "0";
		$packages["ch.iframe.snode.errorpages"] = "0";
		$packages["ch.iframe.snode.css"] = "0";
		$packages["ch.iframe.snode.core"] = "0";
		$packages["ch.iframe.snode.category"] = "0";
		$packages["ch.iframe.snode.banner"] = "0";
		$packages["ch.iframe.snode.articles"] = "0";
	break;
	
}
// create the license for each package
if (is_array($packages)){
	foreach($packages as $package => $limit){
		if ($limit == 0){
			$limit = "";
		}
		exec(LICENSES . "make_licence.sh " .
	    $values['firstname'] . " " .
	    $values['lastname'] . " " .
	    $package . " " .
	    $values['date'] . " " .
	    $values['userid'] . " " .
	    $values['bundleid'] . " " .
	    $values['domainname'] . " " .
	    $limit . " ",$output  );
	    // Assign the output
	    XT::assign('OUTPUT' , $output);
	    // Log the action
	    XT::log('Licence ' .$package . ' created' ,__FILE__,__LINE__,XT_WARNING);
	}
}
// Assign the selected product
XT::assign('SELECTEDPRODUCT',$values['product']);

?>