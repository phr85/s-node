<?php
/*
XT::query("
    DELETE FROM
        " . $GLOBALS['plugin']->getTable("projects_members") . "
    WHERE
        hr_id = " . $GLOBALS['plugin']->getValue("hr_id") . " AND
        project_id = '" . $GLOBALS['plugin']->getSessionValue("project_id") . "'
",__FILE__,__LINE__);
*/
XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable("projects_members") . "
    SET
        hr_id = '" . $GLOBALS['plugin']->getValue("hr_id") . "',
        role = '" . $GLOBALS['plugin']->getValue("role") . "',
        project_id = '" . $GLOBALS['plugin']->getSessionValue("project_id") . "'
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("member_id") . "
    ",__FILE__,__LINE__);

$GLOBALS['plugin']->setAdminModule('e');

?>
