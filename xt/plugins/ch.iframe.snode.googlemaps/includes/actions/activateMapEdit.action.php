<?php

// Call Action Save Map 
XT::call("saveMap");

// Update DB With given data.
XT::query("
    UPDATE 
        " . XT::getTable("googlemaps") . " 
    SET 
        active = 1
    WHERE
        id = " . XT::getValue("id") . "",__FILE__,__LINE__);

// Set Admin Module to "edit"
XT::setAdminModule("edit");
	
?>