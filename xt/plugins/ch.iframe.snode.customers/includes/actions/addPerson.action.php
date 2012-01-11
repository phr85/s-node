<?php

XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable("customers_persons") . "
    (
        customer_id
    ) VALUES (
        '" . $GLOBALS['plugin']->getValue("customer_id") . "'
    )
",__FILE__,__LINE__);

// Get the new id
$result = XT::query("
    SELECT
        id
    FROM
        " . $GLOBALS['plugin']->getTable("customers_persons") . "
    ORDER BY
        id DESC
    LIMIT 1
",__FILE__,__LINE__);

$data = XT::getQueryData($result);

// Set the new id
$GLOBALS['plugin']->setValue("person_id",$data[0]['id']);

$GLOBALS['plugin']->setAdminModule('ep');

?>
