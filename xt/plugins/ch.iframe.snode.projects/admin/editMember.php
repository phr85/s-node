<?php

$GLOBALS['plugin']->contribute("edit_member_buttons", "Save", "saveMember","disk_blue.png","0","");

if($GLOBALS['plugin']->getValue("member_id") != ''){
    $GLOBALS['plugin']->setSessionValue("member_id", $GLOBALS['plugin']->getValue("member_id"));
}

$result = XT::query("
    SELECT * FROM " . $GLOBALS['plugin']->getTable("projects_members") . " WHERE id = " . $GLOBALS['plugin']->getSessionValue("member_id") . "",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("MEMBER",$data[0]);


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

$content = XT::build("editMember.tpl");

?>
