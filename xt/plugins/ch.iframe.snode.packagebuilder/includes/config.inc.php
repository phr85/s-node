<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(6);

// Plugin tables
$GLOBALS['plugin']->addTable('plugins_packages','plugins_packages','List of packages', false);
$GLOBALS['plugin']->addTable('plugins_packages_details','plugins_packages_details','List of packages', false);
$GLOBALS['plugin']->addTable('publish','publish','List of published packages', false);


define("REPOSITORY",DATA_DIR . 'installer/repository/' );
define("PACKAGES",WEBROOT_DIR . '../packages/' );
define("LICENSES",WEBROOT_DIR . '../licenses/' );
define("BIN",WEBROOT_DIR . '../bin/' );
define("PUBLISHED_PACKAGES",WEBROOT_DIR . 'published_packages/' );

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('licence','licence','licence.php',false,true);
$GLOBALS['plugin']->addTab('licence2','licence2','licence2.php',false,true);
$GLOBALS['plugin']->addTab('upload','upload','s1_upload.php',false,false);
$GLOBALS['plugin']->addTab('update','update','s1_update.php',false,false);
$GLOBALS['plugin']->addTab('install','install','s1_install.php',false,false);
$GLOBALS['plugin']->addTab('tree','tree','tree.php',false,false);
$GLOBALS['plugin']->addTab('publish','publish','publish.php',false,true);

// Settings
$GLOBALS['plugin']->addConfig("repository", DATA_DIR . "installer/repository/", "");

// Load permissions
$GLOBALS['plugin']->enablePermissions();

?>
