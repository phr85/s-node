<?php

XT::query("UPDATE " . $GLOBALS['plugin']->getTable("forms_elements_rules") .  "
    SET
        title = '" . $GLOBALS['plugin']->getValue("title") . "',
        compare_type = '" . $GLOBALS['plugin']->getValue("compare_type") . "',
        compare_query = '" . $GLOBALS['plugin']->getValue("compare_query",true) . "',
        value = '" . $GLOBALS['plugin']->getValue("value") . "',
        error_msg = '" . $GLOBALS['plugin']->getValue("error_msg") . "'
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("rule_id") . "
    ",__FILE__,__LINE__);
    
$GLOBALS['plugin']->setAdminModule("eer");

?>
