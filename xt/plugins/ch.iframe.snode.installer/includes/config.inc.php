<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(5);

// Plugin tables
$GLOBALS['plugin']->addTable('plugins_packages','plugins_packages','List of packages', false);
$GLOBALS['plugin']->addTable('plugins_packages_details','plugins_packages_details','List of packages', false);


define("REPOSITORY",DATA_DIR . 'installer/repository/' );

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('slave1','Wizard','slave1.php',false,false);
$GLOBALS['plugin']->addTab('upload','upload','s1_upload.php',false,false);
$GLOBALS['plugin']->addTab('upload_sampledata','upload_sampledata','s1_upload_sampledata.php',false,false);
$GLOBALS['plugin']->addTab('upload_theme','upload_theme','s1_upload_theme.php',false,false);
$GLOBALS['plugin']->addTab('online_update','online_update','s1_online_update.php',false,false);
$GLOBALS['plugin']->addTab('developer_mode','developer_mode','s1_developer_mode.php',false,false);

$GLOBALS['plugin']->addTab('update','update','s1_update.php',false,false);
$GLOBALS['plugin']->addTab('install','install','s1_install.php',false,false);
$GLOBALS['plugin']->addTab('tree','tree','tree.php',false,false);

// Settings
$GLOBALS['plugin']->addConfig("repository", DATA_DIR . "installer/repository/", "");
$GLOBALS['plugin']->addConfig("developer_mode", 0);

// Load permissions
$GLOBALS['plugin']->enablePermissions();

// Load basic function, here special for downloads
require_once(FUNC_DIR . 'basic.functions.php');
?>
