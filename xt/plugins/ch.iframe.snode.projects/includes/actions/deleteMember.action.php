<?php

XT::query("
    DELETE FROM
        " . $GLOBALS['plugin']->getTable("projects_members") . "
    WHERE
        id = " . $GLOBALS['plugin']->getValue("member_id") . "
",__FILE__,__LINE__);

$GLOBALS['plugin']->setAdminModule("e");

?>
