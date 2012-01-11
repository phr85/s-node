<?php

$GLOBALS['plugin']->call("saveEmployee");
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('employees') . " SET image = NULL, image_version = NULL WHERE id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
$GLOBALS['plugin']->setAdminModule("e");

?>
