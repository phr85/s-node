<?php

$GLOBALS['plugin']->setBaseID(70);

// Get absolute path of plugins dir
$plugin_dir = explode('/',getcwd());
array_pop($plugin_dir);
$path = '';

foreach($plugin_dir as $dir) {
    $path .= $dir . '/';
}

$plugin_dir = $path . 'plugins/';

// Plugin configurration
$GLOBALS['plugin']->addConfig('plugin_dir', $plugin_dir, 'Absolute path to plugins directory');
$GLOBALS['plugin']->addConfig('soap_username', 'xt.iframe.ch', 'Username for the soap functionallity');
$GLOBALS['plugin']->addConfig('soap_password', '11f82a64b0b43e61ec2b7a1b708d2d2b', 'Password for the soap functionallity');
$GLOBALS['plugin']->addConfig('soap_options', array('encoding' => 'ISO-8859-1', 'location' => 'http://xt.iframe.ch/soap/server.php', 'uri' => 'http://xt.iframe.ch/soap/'), 'SOAP Options');

// Plugin tables
$GLOBALS['plugin']->addTable('plugins','plugins','installed plugins',false);
$GLOBALS['plugin']->addTable('modfiles','plugins_modfiles','file information of each module',false);
$GLOBALS['plugin']->addTable('modules','plugins_modules','local module repository',false);
$GLOBALS['plugin']->addTable('packages','plugins_packages','local package repository',false);

$GLOBALS['plugin']->addTable('updates', 'updates', 'local packages update repository', false);
$GLOBALS['plugin']->addTable('packages_installed','packages_installed','installed packages');

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Installed Instances','overview.php',true,true);
$GLOBALS['plugin']->addTab('p','Package','showpackage.php',false, false);
$GLOBALS['plugin']->addTab('m','Module','showmodule.php',false, false);
$GLOBALS['plugin']->addTab('u','Updates','updates.php',false, true);
$GLOBALS['plugin']->addTab('r','Get new packages','repository.php',false, true);
$GLOBALS['plugin']->addTab('mr','Get new modules','repository_modules.php',false, true);
$GLOBALS['plugin']->addTab('er','Get new extensions','repository_extensions.php',false, true);
$GLOBALS['plugin']->addTab('i','Installer','install.php',false, true);

// SOAP constants
define('SOAP_ACCESS_DENIED'			, -1);
define('SOAP_CONNECTION_TIMEOUT'	, -2);
define('SOAP_AUTH_FAILED'			, -3);
define('SOAP_AUTH_ERROR'			, -4);
define('SOAP_AUTH_DISABLED'			, -5);
?>