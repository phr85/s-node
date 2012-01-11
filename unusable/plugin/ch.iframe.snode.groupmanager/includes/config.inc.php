<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(120);

// Plugin tables
$GLOBALS['plugin']->addTable('user_groups','user_groups','User -> group assignments data', false);
$GLOBALS['plugin']->addTable('user','user','Main user data', false);
$GLOBALS['plugin']->addTable('groups','groups','Main groups data', false);

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('e','Edit','edit.php',false,false);
$GLOBALS['plugin']->addTab('a','Add','add.php',false,false);


$GLOBALS['plugin']->enablePermissions();
?>
