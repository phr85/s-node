<?php

// Add a new Map
XT::query("INSERT INTO " . XT::getTable('googlemaps') . " (c_date,c_user) 
           VALUES (
           " . time() . ",
           " . XT::getUserID() . "
           )",__FILE__,__LINE__);


// Select the latest entry and assign it to $row
$result = XT::query("SELECT MAX(id) as maxid FROM " . XT::getTable('googlemaps'),__FILE__,__LINE__);
$row = $result->FetchRow();

// Set ID Value according to $row['maxid']
$id = $row['maxid'];
XT::setValue("id", $row['maxid']);
 
// Set Admin Module to "edit"
XT::setAdminModule("edit");

?>