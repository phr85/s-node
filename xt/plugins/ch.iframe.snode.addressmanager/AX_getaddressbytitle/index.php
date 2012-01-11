<?php
$content = '';
$result = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable('addresses') . "
	WHERE title LIKE '%" . $_REQUEST['q'] . "%' AND  active=1 
    ORDER BY
       title ASC
", __FILE__, __LINE__);
 while($row = $result->FetchRow()){
 	$content.= $row['id'] . "|" .  $row['title'] . "\n";
 }
?>
