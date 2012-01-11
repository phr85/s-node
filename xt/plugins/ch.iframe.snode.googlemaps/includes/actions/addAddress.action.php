<?php

// Call Action Save Map 
XT::call("saveMap");

// Determine next position
$position = XT::getQueryData(XT::query("
		SELECT
			max(position)+1 as pos
		FROM
       		" . XT::getTable('googlemaps_entries') . " 
		WHERE
			map_id =  " . XT::getValue('id') . "  "
			));
			
			
// Overwrite Array with Value if empty
if ($position[0]["pos"] == ""){
	$position = 1;
}else{
	$position = $position[0]["pos"];
};

// Add a new Address
XT::query("
    INSERT INTO 
        " . XT::getTable('googlemaps_entries') . " 
    (
        map_id,
        position
    ) VALUES (
        " . XT::getValue('id') . ",
        " . $position . "
    )",__FILE__,__LINE__);

$id = xt::getValue('id');

// Set Values
XT::setValue("id", $row['maxid']);
XT::setValue("id", $id);

// Assign Admin Module to "edit" so user can edit the address right away.
XT::setAdminModule("edit");

?>