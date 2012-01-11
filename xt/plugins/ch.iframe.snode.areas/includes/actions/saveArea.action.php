<?php

$GLOBALS['plugin']->setAdminModule('e');

XT::query("
    UPDATE 
        " . $GLOBALS['plugin']->getTable('areas') . "
    SET
        title = '" . $GLOBALS['plugin']->getValue("title") . "',
        mod_date = " . time() . ",
        mod_user = " . XT::getUserID() . ",
        employee_id = '" . $GLOBALS['plugin']->getValue("employee_id") . "'
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("id") . "
    ",__FILE__,__LINE__);

?>