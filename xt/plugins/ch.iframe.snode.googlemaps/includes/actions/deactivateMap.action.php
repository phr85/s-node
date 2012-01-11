<?php

// Update Database with the selected Map
XT::query("
    UPDATE 
        " . XT::getTable("googlemaps") . " 
    SET 
        active = 0
    WHERE
        id = " . XT::getValue("id") . "",__FILE__,__LINE__);

// Set Admin Module to "overview"
XT::setAdminModule("overview");
	
?>