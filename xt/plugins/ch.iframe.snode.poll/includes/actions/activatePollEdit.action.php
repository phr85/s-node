<?

XT::query("
    UPDATE 
        " . XT::getTable("poll") . " 
    SET 
        active = 1
    WHERE
        id = " . XT::getValue("id") . "",__FILE__,__LINE__);

	XT::setAdminModule("edit");
	
?>