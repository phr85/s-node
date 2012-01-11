<?php

// Re-Organize Positions
$result = XT::query("SELECT
				id,position
			FROM
            	" . XT::getTable("googlemaps_entries") .  " 
            WHERE
            	map_id = " . XT::getValue("map_id") . "
            ORDER BY
            	position ASC
            ",__FILE__,__FILE__);

// Get Positions, write it in array and update database with it.
$i = 1;
while($row = $result->FetchRow()){
	XT::query("
            UPDATE 
            	" . XT::getTable("googlemaps_entries") .  " 
            SET
            	position = " . $i . "
            WHERE 
            	id = " . $row['id'] 
            ,__FILE__,__LINE__);
	$i++;
}
	
?>