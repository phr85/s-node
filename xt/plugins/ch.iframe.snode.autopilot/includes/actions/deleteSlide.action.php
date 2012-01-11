<?php
// Get the maxpos
XT::query("
    DELETE FROM " . $GLOBALS['plugin']->getTable("autopilot_data") . "
    WHERE id= " . XT::getSessionValue("slide_id") . "  AND position = " . XT::getValue("position") ,__FILE__,__LINE__);


$result = XT::query("SELECT id, position FROM " . XT::getTable('autopilot_data') . " WHERE id= " . XT::getSessionValue("slide_id") . " ORDER by position ASC",__FILE__,__LINE__ );
$i = 1;
while($row = $result->FetchRow()){
    XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable("autopilot_data") . "
        SET position = " . $i . "
    WHERE
        id= " . XT::getSessionValue("slide_id") . "
    AND
        position = " . $row['position'] ,__FILE__,__LINE__);
    $i++;
}


?>