<?php

require_once(FUNC_DIR . 'basic.functions.php');

// Set Base id
$GLOBALS['plugin']->setBaseID(1);

$GLOBALS['plugin']->addTable('navigation_contents','navigation_contents','Content table for page', false);
$GLOBALS['plugin']->addTable('plugins_packages','plugins_packages','List of packages', false);
$GLOBALS['plugin']->addTable('plugins_packages_details','plugins_packages_details','List of packages', false);
$GLOBALS['plugin']->addTable('plugins_contents_details','plugins_contents_details','List of packages', false);
$GLOBALS['plugin']->addTable('plugins_modules','plugins_modules','List of modules', false);
$GLOBALS['plugin']->addTable('plugins_params','plugins_params','List of module params', false);
$GLOBALS['plugin']->addTable('plugins_params_details','plugins_params_details','List of module params', false);
$GLOBALS['plugin']->addTable('plugins_contents','plugins_contents','List of module params', false);
$GLOBALS['plugin']->addTable('plugins_contents_rel','plugins_contents_rel','List of module params', false);

$GLOBALS['plugin']->enablePermissions();
 
?>