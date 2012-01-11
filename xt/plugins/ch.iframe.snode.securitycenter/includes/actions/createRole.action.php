<?php
// Create Role
XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('roles') . " (
        title,
        description,
        creation_date,
        creation_user,
        mod_date,
        mod_user
        ) VALUES (
        '" . XT::translate('new role') . "',
        '',
        " . time() . ",
        " . XT::getUserID() . ",
        " . time() . ",
        " . XT::getUserID() . "
        )",__FILE__,__LINE__);

$result = XT::query("SELECT id 
FROM " . $GLOBALS['plugin']->getTable('roles') . "
ORDER BY id desc
Limit 1",__FILE__,__LINE__);

$row = $result->FetchRow();
// Set role id
$GLOBALS['plugin']->setValue("role_id",$row['id']);

$GLOBALS['plugin']->setAdminModule('s1EditRole');
?>