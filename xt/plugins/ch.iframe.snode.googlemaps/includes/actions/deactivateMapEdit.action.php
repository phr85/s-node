<?php

// Call Action Save Map 
XT::call("saveMap");

// Update Database with given Data.
XT::query("
    UPDATE 
        " . XT::getTable("googlemaps") . " 
    SET 
        active = 0
    WHERE
        id = " . XT::getValue("id") . "",__FILE__,__LINE__);

// Set Admin Module to "edit"
XT::setAdminModule("edit");
	
?>