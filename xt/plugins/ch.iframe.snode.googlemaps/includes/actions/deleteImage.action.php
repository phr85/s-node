<?php

// Call Action Save Map 
XT::call("saveMap");

// Update Database with given data.
XT::query("UPDATE 
        " . XT::getTable('googlemaps') . " 
    SET 
        image = NULL,
        image_version = NULL,
        image_zoom = NULL
    WHERE 
        id = " . XT::getValue('id',9100) . "
    ",__FILE__,__LINE__);

// Set Admin Module to "edit"
XT::setAdminModule("edit");

?>