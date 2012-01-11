<?php
// execute query and check for errors
$result = XT::query("SELECT id,title,description,active,creation_date,creation_user,mod_date,mod_user FROM " . $GLOBALS['plugin']->getTable("roles") . " WHERE id = " . $GLOBALS['plugin']->getValue("principal_id") . "",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("ROLE", $data[0]);
XT::assign("PRINCIPAL_ID", $GLOBALS['plugin']->getValue("principal_id"));


$content = XT::build("s1Roles.tpl");

?>
