<?php

if(is_numeric($GLOBALS['plugin']->getValue("id"))){
    $GLOBALS['plugin']->setSessionValue("id", $GLOBALS['plugin']->getValue("id"));
}

if(XT::getPermission('edit')){
    $GLOBALS['plugin']->contribute("edit_buttons", "Save", "saveArea","disk_blue.png","0");
}

// Get area data
$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("areas") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("id") . "
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $row['mod_user'] = XT::getUserName($row['mod_user']);
    $row['c_user'] = $row['creation_user'];
    $row['creation_user'] = XT::getUserName($row['creation_user']);
    $data[] = $row;
}

XT::assign("AREA", $data[0]);

// Get employees
$result = XT::query("
    SELECT
        id,
        firstName,
        lastName,
        email
    FROM
        " . $GLOBALS['plugin']->getTable("employees") . "
    ORDER BY
        lastName ASC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("EMPLOYEES", $data);

$content = XT::build("edit.tpl");

?>