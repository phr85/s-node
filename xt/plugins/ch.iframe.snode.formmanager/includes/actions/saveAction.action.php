<?php

if($GLOBALS['plugin']->getValue("new_type") == 1){
    $GLOBALS['plugin']->setValue("value","");
}

	XT::query("UPDATE " . $GLOBALS['plugin']->getTable("forms_actions") .  "
    SET
        type = '" . $GLOBALS['plugin']->getValue("type") . "',
        value = '" . $GLOBALS['plugin']->getValue("value") . "',
        metadata = '" . XT::getValue("metadata") . "'
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("action_id") . "
    ",__FILE__,__LINE__);

$GLOBALS['plugin']->setAdminModule("ea");

?>
