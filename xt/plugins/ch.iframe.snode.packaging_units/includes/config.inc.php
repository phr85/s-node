<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(2900);

// Plugin tables
$GLOBALS['plugin']->addTable('packaging_units'              ,'packaging_units'             ,'Packaging units main table'     , false);
$GLOBALS['plugin']->addTable('packaging_units_det'          ,'packaging_units_details'     ,'Packaging units details table'  , false);
$GLOBALS['plugin']->addTable('packaging_units_relations'    ,'packaging_units_relations'   ,'Packaging units relations table'  , false);

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('e','Edit','edit.php',false,false);
$GLOBALS['plugin']->addTab('slave1','slave1','slave1.php',false,false);

// Enable Permissions
$GLOBALS['plugin']->enablePermissions();
?>
