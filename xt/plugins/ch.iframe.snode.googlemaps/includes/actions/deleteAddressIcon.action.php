<?php

// Call Action Save Map 
XT::call("saveMap");

// Update Database with given Data
XT::query("UPDATE 
        " . XT::getTable('googlemaps_entries') . " 
    SET 
        icon = NULL
    WHERE 
        id = " . XT::getValue('address_id',9100) . "
    ",__FILE__,__LINE__);

// Set Admin Module to "edit"
XT::setAdminModule("edit");

?>