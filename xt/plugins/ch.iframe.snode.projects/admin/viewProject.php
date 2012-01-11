<?php

if($GLOBALS['plugin']->getValue("project_id") != ''){
    $GLOBALS['plugin']->setSessionValue("project_id", $GLOBALS['plugin']->getValue("project_id"));
}

$GLOBALS['plugin']->contribute('view_buttons','Add relation', 'addRelation','link_add.png','view','');

// Get project data
$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("projects") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("project_id") . "
",__FILE__,__LINE__);

$project_data = array();
while($row = $result->FetchRow()){
    $project_data[] = $row;
}

XT::assign("PROJECT",$project_data[0]);

// Get relation data
$result = XT::query("
    SELECT
        a.content_id,
        a.content_type,
        a.target_content_id,
        a.target_content_type,
        b.title,
        c.title as content_type_title,
        c.icon
    FROM
        " . $GLOBALS['plugin']->getTable("relations") . " as a LEFT JOIN
        " . $GLOBALS['plugin']->getTable("search_infos_global") . "_" . $GLOBALS['plugin']->getActiveLang() . " as b ON (b.content_id = a.target_content_id AND b.content_type = a.target_content_type),
        " . $GLOBALS['plugin']->getTable("content_types") . " as c
    WHERE
        a.content_id = " . $GLOBALS['plugin']->getValue("project_id") . "
        AND a.content_type = " . $GLOBALS['plugin']->getContentType("Project") . "
        AND c.id = a.target_content_type
    ORDER BY
        c.id DESC
    ",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("RELATIONS",$data);

// Get customer information
$result = XT::query("
    SELECT
        id,
        title
    FROM
        " . $GLOBALS['plugin']->getTable("customers") . "
    WHERE
        id = " . $project_data[0]['customer_id'] . "
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("CUSTOMER",$data[0]);

// Get customers persons
$result = XT::query("
    SELECT
        id,
        firstName,
        lastName,
        position
    FROM
        " . $GLOBALS['plugin']->getTable("customers_persons") . "
    WHERE
        id = '" . $project_data[0]['customer_contact_id'] . "'
",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("CUSTOMER_PERSON",$data[0]);

// Get human resources
$result = XT::query("
    SELECT
        id,
        firstName,
        lastName
    FROM
        " . $GLOBALS['plugin']->getTable("employees") . "
    WHERE
        id = " . $project_data[0]['lead_id'] . "
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("EMPLOYEE",$data);

$content = XT::build("viewProject.tpl");

?>
