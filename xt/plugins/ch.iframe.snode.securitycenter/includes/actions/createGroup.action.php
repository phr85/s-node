<?php
// Create Role
XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('groups') . " (
        title,
        description,
        creation_date,
        creation_user,
        mod_date,
        mod_user
        ) VALUES (
        '" . XT::translate('new group') . "',
        '',
        " . time() . ",
        " . XT::getUserID() . ",
        " . time() . ",
        " . XT::getUserID() . "
        )",__FILE__,__LINE__);

$result = XT::query("SELECT id 
FROM " . $GLOBALS['plugin']->getTable('groups') . "
ORDER BY id desc
Limit 1",__FILE__,__LINE__);

$row = $result->FetchRow();
// Set role id
$GLOBALS['plugin']->setValue("group_id",$row['id']);

$GLOBALS['plugin']->setAdminModule('s1EditGroup');
?>