<?php

XT::query("
    INSERT INTO " . $GLOBALS['plugin']->getTable("employees") . " 
    (
        lastName
    ) VALUES (
        ''
    )", __FILE__,__LINE__);
    
$result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable("employees") . " ORDER BY id DESC LIMIT 1");
$data = XT::getQueryData($result);

$GLOBALS['plugin']->setValue("id", $data[0]['id']);
$GLOBALS['plugin']->setAdminModule("e");

?>
