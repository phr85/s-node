<?php

switch($GLOBALS['plugin']->getValue("position")){

    case 'before':
        XT::query("
            UPDATE " . $GLOBALS['plugin']->getTable("forms_actions") .  " SET pos = pos + 1 WHERE form_id = " . $GLOBALS['plugin']->getSessionValue("form_id") . " AND pos >= " . $GLOBALS['plugin']->getValue("insert_position") . "",__FILE__,__LINE__);

        XT::query("
            INSERT INTO
                " . $GLOBALS['plugin']->getTable("forms_actions") .  " (form_id,pos,lang,type) VALUES (" . $GLOBALS['plugin']->getSessionValue("form_id") . "," . ($GLOBALS['plugin']->getValue("insert_position")) . ",'de',1)
            ",__FILE__,__LINE__);

        break;

    case 'after':
        XT::query("
            UPDATE " . $GLOBALS['plugin']->getTable("forms_actions") .  " SET pos = pos + 1 WHERE form_id = " . $GLOBALS['plugin']->getSessionValue("form_id") . " AND pos > " . $GLOBALS['plugin']->getValue("insert_position") . "",__FILE__,__LINE__);

        XT::query("
            INSERT INTO
                " . $GLOBALS['plugin']->getTable("forms_actions") .  " (form_id,pos,lang,type) VALUES (" . $GLOBALS['plugin']->getSessionValue("form_id") . "," . ($GLOBALS['plugin']->getValue("insert_position") + 1) . ",'de',1)
            ",__FILE__,__LINE__);

        break;

}

// Get last insert id
$result = XT::query("
    SELECT id FROM " . $GLOBALS['plugin']->getTable("forms_actions") .  " ORDER BY id DESC LIMIT 1", __FILE__,__LINE__);
while($row = $result->FetchRow()){
    $GLOBALS['plugin']->setValue("action_id", $row['id']);
}

$GLOBALS['plugin']->call("cancel");
$GLOBALS['plugin']->setAdminModule("ea");

?>
