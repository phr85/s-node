<?php

require_once(FUNC_DIR . 'basic.functions.php');

// Base ID
$GLOBALS['plugin']->setBaseID(7300);

// Declare the used database tables
XT::addTable('navigation_details','navigation_details'   ,'Naviogation details'  , false);
XT::addTable('plugins_packages','plugins_packages'   ,'Plugins'  , false);
XT::addTable('plugins_packages_details','plugins_packages_details'   ,'Plugin details'  , false);
XT::addTable('plugins_modules','plugins_modules'   ,'Modules'  , false);
XT::addTable('navigation','navigation'   ,'navigation'  , false);
XT::addTable('navigation_contents','navigation_contents'   ,'Contents'  , false);
XT::addTable('content_types','content_types'   ,'Content types'  , false);
XT::addTable('plugins_params','plugins_params'   ,'Plugin parameter'  , false);
XT::addTable('plugins_params_details','plugins_params_details'   ,'Plugin parameter details'  , false);

// Plugin content type contributions
$GLOBALS['plugin']->addContentType(60, "Page");

// Plugin configuration
$GLOBALS['plugin']->addConfig('node_manager_tpl', 110, 'Template ID for the node manager popup');
$GLOBALS['plugin']->addConfig('node_manager_base_id', 150, 'Template ID for the node manager popup');
$GLOBALS['plugin']->addConfig('admin_tpl', 605, 'Template ID for the node manager popup');
$GLOBALS['plugin']->addConfig('article_viewer_tpl', 726, '');
$GLOBALS['plugin']->addConfig('articles_baseid', 270, '');
?>