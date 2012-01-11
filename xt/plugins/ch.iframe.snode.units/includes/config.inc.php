<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(2900);

// Plugin tables
$GLOBALS['plugin']->addTable('units'    ,'units'           ,'Units main table'     , false);
$GLOBALS['plugin']->addTable('units_det','units_details'   ,'Units details table'  , false);
$GLOBALS['plugin']->addTable('units_relations','units_relations'   ,'Units relations table'  , false);

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('e','Edit','edit.php',false,false);
$GLOBALS['plugin']->addTab('slave1','slave1','slave1.php',false,false);

// Enable Permissions
$GLOBALS['plugin']->enablePermissions();
?>
