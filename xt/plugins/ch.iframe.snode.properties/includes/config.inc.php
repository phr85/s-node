<?php
// Set Base id
$GLOBALS['plugin']->setBaseID(7500);

// include tables and property types
include_once("config.ext.inc.php");

if($GLOBALS['plugin']->module=='admin'){
include_once('config.admin.inc.php');
}

// Plugin admin tabs
$GLOBALS['plugin']->addTab('po','Properties','properties_overview.php',true,true);
$GLOBALS['plugin']->addTab('go','Properties Groups','groups_overview.php',false,true);
$GLOBALS['plugin']->addTab('pe','tab:edit_property','properties_edit.php',false,false);
$GLOBALS['plugin']->addTab('ge','tab:edit_groups','groups_edit.php',false,false);
$GLOBALS['plugin']->addTab('slave1','slave1','slave1.php',false,false);

// Enable Permissions
$GLOBALS['plugin']->enablePermissions();

?>
