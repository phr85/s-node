<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

if($GLOBALS['plugin']->getValue("open") != ''){
    $GLOBALS['plugin']->setSessionValue("open", $GLOBALS['plugin']->getValue("open"));
}

// Enable Char filter and navigator
XT::enableAdminCharFilter('title');
XT::enableAdminNavigator('customers');

$result = XT::query("
    SELECT
        id,
        title,
        active,
        postalCode,
        city,
        cnr,
        tel
    FROM
        " . $GLOBALS['plugin']->getTable("customers") . XT::getAdminCharFilter() . "
    ORDER BY
        title ASC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);

XT::assign("CUSTOMERS", XT::getQueryData($result));

if($GLOBALS['plugin']->getSessionValue("open") != ''){
    $result = XT::query("
        SELECT
            id,
            active,
            customer_id,
            lastName,
            firstName,
            position,
            email
        FROM
            " . $GLOBALS['plugin']->getTable("customers_persons") . "
        WHERE
            customer_id = " . $GLOBALS['plugin']->getSessionValue("open") . "
        ORDER BY
            lastName ASC
        ",__FILE__,__LINE__);

    $persons = array();
    while($row = $result->FetchRow()){
        $persons[$row['customer_id']][] = $row;
    }

    XT::assign("PERSONS", $persons);
}

$content = XT::build("overview.tpl");

?>
