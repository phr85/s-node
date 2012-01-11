<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

// Enable Char filter and navigator
XT::enableAdminNavigator('','',"
    SELECT
        count(a.id)
    FROM
        " . $GLOBALS['plugin']->getTable("projects") . " as a
    WHERE
        a.status = 0
    ");

$result = XT::query("
    SELECT
        a.id,
        a.title,
        b.title as company
    FROM
        " . $GLOBALS['plugin']->getTable("projects") . " as a LEFT JOIN
        " . $GLOBALS['plugin']->getTable("customers") . " as b ON (b.id = a.customer_id)
    WHERE
        a.status = 0
    ORDER BY
        a.title ASC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);

XT::assign("PROJECTS", XT::getQueryData($result));

$content = XT::build("overview.tpl");

?>
