<?php

XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable("forms_elements_values") .  " (element_id,pos) VALUES (" . $GLOBALS['plugin']->getSessionValue("element_id") . ",1)
    ",__FILE__,__LINE__);

// Get last insert id
$result = XT::query("
    SELECT id FROM " . $GLOBALS['plugin']->getTable("forms_elements_values") .  " ORDER BY id DESC LIMIT 1", __FILE__,__LINE__);
while($row = $result->FetchRow()){
    $GLOBALS['plugin']->setValue("value_id", $row['id']);
}

$GLOBALS['plugin']->setAdminModule("eev");

?>
