<?php
set_time_limit(0);
// alle relations auslesen
$result = XT::query("SELECT * FROM " . XT::getTable("relations"),__FILE__,__LINE__);
while ($row = $result->fetchRow()) {
    $title = XT::getTitleByContentType($row['content_type'],$row['content_id'],$row['lang']);
    $target_title = XT::getTitleByContentType($row['target_content_type'],$row['target_content_id'],$row['lang']);
	if($title===false || $target_title===false){
	    //löschen
         XT::query("DELETE from " . XT::getTable("relations") . " WHERE id=" . $row['id'],__FILE__,__LINE__);
	}else {
	    //aktualisieren
		XT::query("UPDATE " . XT::getTable("relations") . " set title='" . $title . "', target_title='" . $target_title . "' WHERE id=" . $row['id'],__FILE__,__LINE__);
	}
	$i++;
}
XT::log($i . " objects checked",__FILE__,__LINE__,XT_INFO);
?>