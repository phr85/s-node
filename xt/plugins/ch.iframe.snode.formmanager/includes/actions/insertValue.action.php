<?php

switch($GLOBALS['plugin']->getValue("position")){

    case 'before':
        XT::query("
            UPDATE " . $GLOBALS['plugin']->getTable("forms_elements_values") .  " SET pos = pos + 1 WHERE element_id = " . $GLOBALS['plugin']->getSessionValue("element_id") . " AND pos >= " . $GLOBALS['plugin']->getValue("insert_position") . "",__FILE__,__LINE__);

        XT::query("
            INSERT INTO
                " . $GLOBALS['plugin']->getTable("forms_elements_values") .  " (element_id,pos) VALUES (" . $GLOBALS['plugin']->getSessionValue("element_id") . "," . ($GLOBALS['plugin']->getValue("insert_position")) . ")
            ",__FILE__,__LINE__);

        break;

    case 'after':
        XT::query("
            UPDATE " . $GLOBALS['plugin']->getTable("forms_elements_values") .  " SET pos = pos + 1 WHERE element_id = " . $GLOBALS['plugin']->getSessionValue("element_id") . " AND pos > " . $GLOBALS['plugin']->getValue("insert_position") . "",__FILE__,__LINE__);

        XT::query("
            INSERT INTO
                " . $GLOBALS['plugin']->getTable("forms_elements_values") .  " (element_id,pos) VALUES (" . $GLOBALS['plugin']->getSessionValue("element_id") . "," . ($GLOBALS['plugin']->getValue("insert_position") + 1) . ")
            ",__FILE__,__LINE__);

        break;

}

// Get last insert id
$result = XT::query("
    SELECT id FROM " . $GLOBALS['plugin']->getTable("forms_elements_values") .  " ORDER BY id DESC LIMIT 1", __FILE__,__LINE__);
while($row = $result->FetchRow()){
    $GLOBALS['plugin']->setValue("value_id", $row['id']);
}

$GLOBALS['plugin']->call("cancelAddValue");
$GLOBALS['plugin']->setAdminModule("eev");

?>
