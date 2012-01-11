<?

XT::query("
    UPDATE 
        " . $GLOBALS['plugin']->getTable("poll") . " 
    SET 
        active = 0
    WHERE
        id = " . $GLOBALS['plugin']->getValue("id") . "",__FILE__,__LINE__);

	XT::setAdminModule("overview");
	
?>