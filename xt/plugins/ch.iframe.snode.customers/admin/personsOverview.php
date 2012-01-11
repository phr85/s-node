<?php

// Enable Char filter and navigator
XT::enableAdminCharFilter('lastName');
XT::enableAdminNavigator('customers_persons');

$result = XT::query("
    SELECT
        a.id,
        a.firstName,
        a.lastName,
        a.position,
        a.active,
        a.cnr,
        a.tel,
        a.email,
        b.title as company
    FROM
        " . $GLOBALS['plugin']->getTable("customers_persons") . " as a LEFT JOIN
        " . $GLOBALS['plugin']->getTable("customers") . " as b ON (b.id = a.customer_id)
        " . XT::getAdminCharFilter() . "
    ORDER BY
        lastName ASC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);

XT::assign("PERSONS", XT::getQueryData($result));

$content = XT::build("personsOverview.tpl");

?>
