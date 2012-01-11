<?php
$GLOBALS['plugin']->setBaseID(4200);

// Plugin tables
$GLOBALS['plugin']->addTable('content_types','content_types','Table with content types',false);

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('e','Edit','edit.php',false,false);
$GLOBALS['plugin']->addTab('slave1','slave1','slave1.php',false,false);

// Enable permissions
$GLOBALS['plugin']->enablePermissions();
?>