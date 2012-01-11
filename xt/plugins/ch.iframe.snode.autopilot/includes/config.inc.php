<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(4800);

// Plugin tables
XT::addTable('autopilot');
XT::addTable('autopilot_data');

$GLOBALS['plugin']->addContentType(4800, "Slideshow");

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('e','Edit zone','edit.php',false,false);
$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);
$GLOBALS['plugin']->addTab('slide','slide','slide.php',false,false);

// Load permissions
$GLOBALS['plugin']->enablePermissions();

?>
