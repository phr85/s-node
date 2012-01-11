<?php

XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable("customers") . "
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
        " . $GLOBALS['plugin']->getTable("customers") . "
    ORDER BY
        id DESC
    LIMIT 1
",__FILE__,__LINE__);

$data = XT::getQueryData($result);

// Set the new id
$GLOBALS['plugin']->setValue("customer_id",$data[0]['id']);

$GLOBALS['plugin']->setAdminModule('ec');

?>
