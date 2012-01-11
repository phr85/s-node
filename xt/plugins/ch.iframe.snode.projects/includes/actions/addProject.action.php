<?php

XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable("projects") . "
    (
        title
    ) VALUES (
        ''
    )
",__FILE__,__LINE__);

// Get the new id
$result = XT::query("
    SELECT
        id
    FROM
        " . $GLOBALS['plugin']->getTable("projects") . "
    ORDER BY
        id DESC
    LIMIT 1
",__FILE__,__LINE__);

$data = XT::getQueryData($result);

// Set the new id
$GLOBALS['plugin']->setValue("project_id",$data[0]['id']);

$GLOBALS['plugin']->setAdminModule('e');

?>
