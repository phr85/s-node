<?php

XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable("autopilot") . "
    (
        creation_date,
        creation_user
    ) VALUES (
        " . time() . ",
        " . XT::getUserID() . "
    )
",__FILE__,__LINE__);

// Get the new id
$result = XT::query("
    SELECT
        id
    FROM
        " . $GLOBALS['plugin']->getTable("autopilot") . "
    ORDER BY
        id DESC
    LIMIT 1
",__FILE__,__LINE__);

$data = XT::getQueryData($result);

// Set the new id
$GLOBALS['plugin']->setValue("slide_id",$data[0]['id']);

$GLOBALS['plugin']->setAdminModule('e');

?>
