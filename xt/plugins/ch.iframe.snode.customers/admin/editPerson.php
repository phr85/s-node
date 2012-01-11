<?php

if($GLOBALS['plugin']->getValue("person_id") != ''){
    $GLOBALS['plugin']->setSessionValue("person_id", $GLOBALS['plugin']->getValue("person_id"));
}

$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("customers_persons") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("person_id") . "
    ",__FILE__,__LINE__);

$data = XT::getQueryData($result);
XT::assign("PERSON", $data[0]);

// Get customers
$result = XT::query("
    SELECT
        id,
        title
    FROM
        " . $GLOBALS['plugin']->getTable("customers") . "
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("CUSTOMERS",$data);

// Get users
$result = XT::query("
    SELECT
        id,
        username
    FROM
        " . $GLOBALS['plugin']->getTable("user") . "
    ORDER BY
        username DESC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("USERS",$data);

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

$content = XT::build("editPerson.tpl");

?>
