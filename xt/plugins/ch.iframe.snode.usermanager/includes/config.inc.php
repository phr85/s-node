<?php


// Set Base id
$GLOBALS['plugin']->setBaseID(110);

// Plugin tables
$GLOBALS['plugin']->addTable('user','user','Main user data', false);
$GLOBALS['plugin']->addTable('customers_persons','customers_persons','Main customers data', false);
$GLOBALS['plugin']->addTable('tracking','tracking','User tracking data', false);

$GLOBALS['plugin']->addConfig("image_picker_base_id", 240, "");
$GLOBALS['plugin']->addConfig("image_picker_tpl", 107, "");
$GLOBALS['plugin']->addConfig("lost_tpl", 702, "");

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('e','Edit','edit.php',false,false);
$GLOBALS['plugin']->addTab('a','Add','add.php',false,false);
$GLOBALS['plugin']->addTab('slave1','Slave 1','slave1.php',false,false);

$GLOBALS['plugin']->addContentType(3, "User");

// Enable Permissions
$GLOBALS['plugin']->enablePermissions();

include_once('library.inc.php');
?>
