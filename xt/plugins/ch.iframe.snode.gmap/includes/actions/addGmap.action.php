<?php
// Add a Gmap
XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('gmap') . " (creation_date,creation_user,lang) 
           VALUES (
           " . time() . ",
           " . XT::getUserID() . ",
           '" . $GLOBALS['plugin']->getActiveLang() . "'
           )",__FILE__,__LINE__);

$result = XT::query("SELECT MAX(id) as maxid FROM " . $GLOBALS['plugin']->getTable('gmap'),__FILE__,__LINE__);
$row = $result->FetchRow();

$GLOBALS['plugin']->setValue("id", $row['maxid']);
$GLOBALS['plugin']->setAdminModule("edit");
?>