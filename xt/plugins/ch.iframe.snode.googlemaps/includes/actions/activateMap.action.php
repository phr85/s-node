<?php

// Activate selected map
XT::query("
    UPDATE 
        " . XT::getTable("googlemaps") . " 
    SET 
        active = 1
    WHERE
        id = " . XT::getValue("id") . "",__FILE__,__LINE__);

// Set Admin Module to "overview"
XT::setAdminModule("overview");

?>