<?php

XT::call('savePoll');
XT::call("reOrderPositions");


// Select Clicked Item Position
$result = XT::query("SELECT id,position
			FROM " . XT::getTable("answers") ." 
			WHERE 
				id = " . XT::getValue("answer_id") . "
");

while($row = $result->FetchRow()){
	$clicked_position = $row['position'];
	$clicked_id = $row['id'];
}

// What icon did the user select?
switch(XT::getValue("direction")){
	
	// Move Answer Up
    case 'moveUp':
       
    	// Move Upper Item Down First
        XT::query("
            UPDATE 
            	" . XT::getTable("answers") .  " 
            SET 
            	position = " . $clicked_position . "
            WHERE
            	position = " . $clicked_position . " - 1 
            ",__FILE__,__LINE__);
        
        // Then Move the selected Item Up
        XT::query("
            UPDATE 
            	" . XT::getTable("answers") .  " 
            SET
            	position = " . $clicked_position . " - 1
            WHERE 
            	id = " . $clicked_id . "
            ",__FILE__,__LINE__);
        break;
        
	// Move Answer Down
    case 'moveDown':
    	
    	// Move Under Item Up First
        XT::query("
            UPDATE 
            	" . XT::getTable("answers") .  " 
            SET 
            	position = " . $clicked_position . "
            WHERE
            	position = " . $clicked_position . " + 1 
            ",__FILE__,__LINE__);
        
        // Then Move the selected Item down
        XT::query("
            UPDATE 
            	" . XT::getTable("answers") .  " 
            SET
            	position = " . $clicked_position . " + 1
            WHERE 
            	id = " . $clicked_id . "
            ",__FILE__,__LINE__);
        break;
}

// Get last insert id
$result = XT::query("
    SELECT id FROM " . XT::getTable("answers") .  " ORDER BY id DESC LIMIT 1", __FILE__,__LINE__);
while($row = $result->FetchRow()){
    XT::setValue("element_id", $row['element_id']);
}

XT::setAdminModule("edit");

?>