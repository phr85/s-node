<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(90);

// Plugin tables
$GLOBALS['plugin']->addTable('user','user','Users', false);
$GLOBALS['plugin']->addTable('relations','relations','Relations', false);
$GLOBALS['plugin']->addTable('content_types','content_types','content_types', false);
$GLOBALS['plugin']->addTable('search_infos_global','search_infos_global','search_infos_global', false);
$GLOBALS['plugin']->addTable('faq','faq','FAQ tree', false);
$GLOBALS['plugin']->addTable('faq_details','faq_details','FAQ tree', false);
$GLOBALS['plugin']->addTable('faq_rel','faq_rel','FAQ tree', false);
$GLOBALS['plugin']->addTable('faq_tree','faq_tree','FAQ tree', false);
$GLOBALS['plugin']->addTable('faq_tree_details','faq_tree_details','FAQ tree details', false);

// Plugin config variables
$GLOBALS['plugin']->addConfig('config_var', 'config_var_value', 'Config variable description');

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('b','Browser','browser.php',false,false);
$GLOBALS['plugin']->addTab('ea','Edit article','editArticle.php',false,false);
$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);
$GLOBALS['plugin']->addTab('en','Edit folder','edit_node.php',false,false);

// Add content types provided by this plugin
$GLOBALS['plugin']->addContentType(5, "FAQ Article");

$GLOBALS['plugin']->enablePermissions();
?>