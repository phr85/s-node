<?php
if (XT::getConfig("log_actions") == true){
	// Count click
	XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable("clicks") . " (zone_id,session_id,call_date,referer)
	    VALUES (
	        '" . $GLOBALS['plugin']->getValue("zone_id") . "',
	        '" . session_id() . "',
	        '" . time() . "',
	        '" . $_SERVER['HTTP_REFERER'] . "'
	    )
	",__FILE__,__LINE__);
}
// Update click count for actual banner and zone
XT::query("UPDATE
    " . $GLOBALS['plugin']->getTable("banner_zones_rel") . "
    SET clicks = clicks+1
    WHERE banner_id = '" . $GLOBALS['plugin']->getValue("banner_id") . "'
    AND zone_id = '" . $GLOBALS['plugin']->getValue("zone_id") . "'
");

header("Location: " . $GLOBALS['plugin']->getValue("link"));

?>
