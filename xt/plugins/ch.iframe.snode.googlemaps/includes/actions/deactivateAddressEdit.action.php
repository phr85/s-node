<?php

// Call Action Save Map 
XT::call("saveMap");

// Update DB With given data.
XT::query("
    UPDATE 
        " . XT::getTable("googlemaps_entries") . " 
    SET 
        active = 0
    WHERE
        id = " . XT::getValue("address_id") . "",__FILE__,__LINE__);

// Set Admin Module to "edit"
XT::setAdminModule("edit");

?>