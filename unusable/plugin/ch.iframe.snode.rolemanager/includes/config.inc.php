<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(130);

// Plugin tables
$GLOBALS['plugin']->addTable('user_roles','user_roles','User -> role assignments data', false);
$GLOBALS['plugin']->addTable('group_roles','group_roles','Group -> role assignments data', false);
$GLOBALS['plugin']->addTable('user','user','Main user data', false);
$GLOBALS['plugin']->addTable('groups','groups','Main groups data', false);
$GLOBALS['plugin']->addTable('roles','roles','Main roles data', false);

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('e','Edit','edit.php',false,false);
$GLOBALS['plugin']->addTab('a','Add','add.php',false,false);

$GLOBALS['plugin']->enablePermissions();
?>
