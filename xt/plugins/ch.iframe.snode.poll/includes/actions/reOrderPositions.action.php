<?php

// Re-Organize Positions
$result = XT::query("SELECT
				id,position
			FROM
            	" . XT::getTable("answers") .  " 
            WHERE
            	poll_id = " . XT::getValue("poll_id") . "
            ORDER BY
            	position ASC
            ",__FILE__,__FILE__);

// Get Positions, write it in array.
$i = 1;
while($row = $result->FetchRow()){
	XT::query("
            UPDATE 
            	" . XT::getTable("answers") .  " 
            SET
            	position = " . $i . "
            WHERE 
            	id = " . $row['id'] 
            ,__FILE__,__LINE__);
	$i++;
}

	
?>