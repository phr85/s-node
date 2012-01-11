<?php

// Add a new Poll
XT::query("INSERT INTO " . XT::getTable('poll') . " (creation_date,creation_user,lang) 
           VALUES (
           " . time() . ",
           " . XT::getUserID() . ",
           '" . $GLOBALS['plugin']->getActiveLang() . "'
           )",__FILE__,__LINE__);

$result = XT::query("SELECT MAX(id) as maxid FROM " . XT::getTable('poll'),__FILE__,__LINE__);
$row = $result->FetchRow();


XT::setValue("id", $row['maxid']);
XT::setAdminModule("edit");

?>