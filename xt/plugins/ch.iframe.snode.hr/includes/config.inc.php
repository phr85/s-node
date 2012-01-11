<?php

$GLOBALS['plugin']->setBaseID(1600);

$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('e','Edit employee','editEmployee.php',false,false);
$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);

$GLOBALS['plugin']->addTable('employees','employees','Main employees data', false);
$GLOBALS['plugin']->addTable('user','user','Main user data', false);

// Image picker
$GLOBALS['plugin']->addConfig("image_picker_base_id", 240, "");
$GLOBALS['plugin']->addConfig("image_picker_tpl", 597, "");

$GLOBALS['plugin']->enablePermissions();

?>
