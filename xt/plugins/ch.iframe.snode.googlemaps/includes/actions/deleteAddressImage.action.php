<?php

// Call Action Save Map 
XT::call("saveMap");

// Update Database with given Data
XT::query("UPDATE 
        " . XT::getTable('googlemaps_entries') . " 
    SET 
        image = NULL,
        image_version = NULL
    WHERE 
       	id = " . XT::getValue('address_id',9100) . "
    ",__FILE__,__LINE__);

// Set Admin Module "edit"
XT::setAdminModule("edit");

?>