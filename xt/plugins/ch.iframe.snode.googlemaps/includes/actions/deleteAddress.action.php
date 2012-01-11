<?php

// Call Action Save Map 
XT::call("saveMap");

// Delete Address from Database.
XT::query("DELETE FROM " . XT::getTable("googlemaps_entries_lang") . " WHERE entry_id = " . XT::getValue("address_id") . "",__FILE__,__LINE__);
XT::query("DELETE FROM " . XT::getTable("googlemaps_entries") . " WHERE id = " . XT::getValue("address_id") . "",__FILE__,__LINE__);

// Set Admin Module to "edit"
XT::setAdminModule("edit");

?>