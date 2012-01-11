<?php
// Save edit id
if(is_numeric($GLOBALS['plugin']->getValue("customer_id"))){
    $GLOBALS['plugin']->setSessionValue("customer_id", $GLOBALS['plugin']->getValue("customer_id"));
}

// Get detail view mode
$customer_mode = $GLOBALS['plugin']->getSessionValue('customer_mode');
if($GLOBALS['plugin']->getValue("customer_mode") != ''){
    $customer_mode = $GLOBALS['plugin']->getValue("customer_mode");
    $GLOBALS['plugin']->setSessionValue('customer_mode', $customer_mode);
}
if($customer_mode == ''){
    $customer_mode = 'contact_persons';
    $GLOBALS['plugin']->setSessionValue('customer_mode', $customer_mode);
}
XT::assign("CUSTOMER_MODE", $GLOBALS['plugin']->getSessionValue('customer_mode'));

// Get customer data
$result = XT::query("
    SELECT
        id,
        title,
        cnr,
        postalCode,
        city,
        facsimile,
        tel,
        our_consultant,
        our_technician,
        po_box,
        street,
        street_nr,
        country
    FROM
        " . $GLOBALS['plugin']->getTable("customers") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("customer_id") . "
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("CUSTOMER", $data[0]);

// Get human resources
$result = XT::query("
    SELECT
        id,
        firstName,
        lastName
    FROM
        " . $GLOBALS['plugin']->getTable("employees") . "
    ORDER BY
        lastName ASC,
        firstName ASC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("EMPLOYEES",$data);

// Enable Char filter and navigator
XT::enableAdminCharFilter('lastName');
XT::enableAdminNavigator('','',"
    SELECT
        count(a.id)
    FROM
        " . $GLOBALS['plugin']->getTable("customers_persons") . " as a,
        " . $GLOBALS['plugin']->getTable("customers") . " as b
    WHERE
        a.customer_id = " . $GLOBALS['plugin']->getSessionValue("customer_id") . " AND
        b.id = a.customer_id " . XT::getAdminCharFilter('AND') . "
    ORDER BY
        lastName ASC");

$result = XT::query("
    SELECT
        a.id,
        a.firstName,
        a.lastName,
        a.position,
        a.active,
        b.title as company
    FROM
        " . $GLOBALS['plugin']->getTable("customers_persons") . " as a,
        " . $GLOBALS['plugin']->getTable("customers") . " as b
    WHERE
        a.customer_id = " . $GLOBALS['plugin']->getSessionValue("customer_id") . " AND
        b.id = a.customer_id " . XT::getAdminCharFilter('AND') . "
    ORDER BY
        lastName ASC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);

XT::assign("PERSONS", XT::getQueryData($result));

// Get countries
$result = XT::query("
    SELECT
        country,
        name
    FROM 
        " . XT::getTable('countries') . "
    ORDER BY
        name ASC
",__FILE__,__LINE__);

XT::assign("COUNTRIES",XT::getQueryData($result));

$content = XT::build("editCustomer.tpl");

?>
