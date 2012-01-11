<?php
switch(XT::getParam('action')){ 
	
	case "getregion":
	// Get all results for a country from the database
	$result = XT::query("SELECT  * FROM " . $GLOBALS['plugin']->getTable("countries_regions") . " WHERE country='" . XT::getParam('country') . "'",__FILE__,__LINE__);
	$content = "";
	while($row = $result->FetchRow()) {
		// Add to the content a string in style of a javascript function for the client side. This code
		// will be executed with the function eval(...).
		$content .= "appendOptionLast('" . addslashes($row["name"]) . "','" . $row["region"] . "');\n";
	}
	break;
	
	default:
	$content = "";
	break;
}
?>