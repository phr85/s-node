<?php

XT::query("
    INSERT INTO " . $GLOBALS['plugin']->getTable("projects_members") . "
    (
        role
    ) VALUES (
        ''
    )
",__FILE__,__LINE__);

// Get id
$result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable("projects_members") . " ORDER BY id DESC LIMIT 1",__FILE__,__LINE__);

$data = XT::getQueryData($result);
$GLOBALS['plugin']->setValue("member_id", $data[0]['id']);

$GLOBALS['plugin']->setAdminModule("em");

?>
