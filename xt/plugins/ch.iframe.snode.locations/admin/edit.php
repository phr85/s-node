<?php

// Get location id
if(XT::getValue("location_id") != ''){
    XT::setSessionValue("location_id", XT::getValue("location_id"));
}

// Add buttons
XT::addImageButton('Save','save','default','disk_blue.png',0,'slave1');

// Get location data
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable('company_locations') . "
    WHERE
        id = '" . XT::getSessionValue("location_id") . "'
",__FILE__,__LINE__);

$location = array();
while($row = $result->FetchRow()){
    $location = $row;
}

// Get countries
$result = XT::query("
    SELECT
        country,
        name
    FROM 
        " . XT::getTable('countries') . "
    ORDER BY
        name ASC
",__FILE__,__LINE__);

XT::assign("COUNTRIES",XT::getQueryData($result));

// Assign location data
XT::assign("LOCATION", $location);

// Write output into buffer
$content = XT::build('edit.tpl');

?>
