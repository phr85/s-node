<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

// Enable Char filter and navigator
XT::enableAdminCharFilter('lastName');
XT::enableAdminNavigator('employees');

// Get users list
$result = XT::query("
    SELECT
        id,
        lastName,
        firstName,
        email,
        active
    FROM
        " . XT::getTable('employees') . XT::getAdminCharFilter() . "
    ORDER BY
        lastName ASC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);

XT::assign("DATA", XT::getQueryData($result));

$content = XT::build("overview.tpl");

?>
