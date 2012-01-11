<?php

if($GLOBALS['plugin']->getValue("id") != ''){
    $GLOBALS['plugin']->setSessionValue("id", $GLOBALS['plugin']->getValue("id"));
}

$result = XT::query("
    SELECT
        *
    FROM " . $GLOBALS['plugin']->getTable("employees") . "
    WHERE id = " . $GLOBALS['plugin']->getSessionValue("id") . "",__FILE__,__LINE__);

$data = XT::getQueryData($result);
XT::assign("EMPLOYEE", $data[0]);

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

//Images
XT::assign("IMAGE_PICKER_TPL", $GLOBALS['plugin']->getConfig("image_picker_tpl"));
XT::assign("IMAGE_PICKER_BASE_ID", $GLOBALS['plugin']->getConfig("image_picker_base_id"));

$content = XT::build("editEmployee.tpl");

?>
