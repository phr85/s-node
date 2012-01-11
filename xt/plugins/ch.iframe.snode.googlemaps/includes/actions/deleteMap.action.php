<?php

// SQL
$result = XT::query("
    SELECT
       id
    FROM
        " . XT::getTable('googlemaps_entries') . "
    WHERE
    	map_id = " . XT::getValue("id") . "
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row['id'];
}

// Eintraege löschen
XT::query("DELETE FROM " . XT::getTable("googlemaps_entries_lang") . " WHERE entry_id IN (" . implode(",",$data) . ")",__FILE__,__LINE__);
XT::query("DELETE FROM " . XT::getTable("googlemaps_entries") . " WHERE map_id = " . XT::getValue("id") . "",__FILE__,__LINE__);

// Delete Map and address entries for map that has to be deleted.
XT::query("DELETE FROM " . XT::getTable("googlemaps_lang") . " WHERE map_id = " . XT::getValue("id") . "",__FILE__,__LINE__);
XT::query("DELETE FROM " . XT::getTable("googlemaps") . " WHERE id = " . XT::getValue("id") . "",__FILE__,__LINE__);


// Set Admin Module to "overview"
XT::setAdminModule("overview");

?>