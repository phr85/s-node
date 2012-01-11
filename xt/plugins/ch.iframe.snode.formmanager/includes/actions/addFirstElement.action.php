<?php

XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable("forms_elements") .  " (form_id,pos,active,lang) VALUES (" . $GLOBALS['plugin']->getSessionValue("form_id") . ",1,0,'de')
    ",__FILE__,__LINE__,0);

// Get last insert id
$result = XT::query("
    SELECT element_id FROM " . $GLOBALS['plugin']->getTable("forms_elements") .  " ORDER BY element_id DESC LIMIT 1", __FILE__,__LINE__);
while($row = $result->FetchRow()){
    $GLOBALS['plugin']->setValue("element_id", $row['element_id']);
}

$GLOBALS['plugin']->setAdminModule("ee");

?>
