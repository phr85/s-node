<?php

// Call Action Save Map 
XT::call("saveMap");

// Call action that reorders positions
XT::call("reOrderPositions");

// Select Clicked Address Position
$result = XT::query("SELECT id,position
			FROM " . XT::getTable("googlemaps_entries") ." 
			WHERE 
				id = " . XT::getValue("address_id") . "
");

// Reorganize...
while($row = $result->FetchRow()){
	$clicked_position = $row['position'];
	$clicked_id = $row['id'];
}

// What icon did the user select?
switch(XT::getValue("direction")){
	
	// Move Answer Up
    case 'moveUp':
       
    	// Move Upper Address Down First
        XT::query("
            UPDATE 
            	" . XT::getTable("googlemaps_entries") .  " 
            SET 
            	position = " . $clicked_position . "
            WHERE
            	position = " . $clicked_position . " - 1 
            ",__FILE__,__LINE__);
        
        // Then Move the selected Address Up
        XT::query("
            UPDATE 
            	" . XT::getTable("googlemaps_entries") .  " 
            SET
            	position = " . $clicked_position . " - 1
            WHERE 
            	id = " . $clicked_id . "
            ",__FILE__,__LINE__);
        break;
        
	// Move Answer Down
    case 'moveDown':
    	
    	// Move Under Address Up First
        XT::query("
            UPDATE 
            	" . XT::getTable("googlemaps_entries") .  " 
            SET 
            	position = " . $clicked_position . "
            WHERE
            	position = " . $clicked_position . " + 1 
            ",__FILE__,__LINE__);
        
        // Then Move the selected Address down
        XT::query("
            UPDATE 
            	" . XT::getTable("googlemaps_entries") .  " 
            SET
            	position = " . $clicked_position . " + 1
            WHERE 
            	id = " . $clicked_id . "
            ",__FILE__,__LINE__);
        break;
}

// Get last insert id
$result = XT::query("
    SELECT id FROM " . XT::getTable("googlemaps_entries") .  " ORDER BY id DESC LIMIT 1", __FILE__,__LINE__);
while($row = $result->FetchRow()){
    XT::setValue("element_id", $row['element_id']);
}

// Set Admin Module to "edit"
XT::setAdminModule("edit");

?>