<?php
// Set Base id
$GLOBALS['plugin']->setBaseID(1200);

// Plugin tables
$GLOBALS['plugin']->addTable('shop_articles','shop_articles','product of month and present', false);
$GLOBALS['plugin']->addTable('articles_details','catalog_articles_details','detail informations for the articles', false);
$GLOBALS['plugin']->addTable('articles_relations','catalog_articles_relations','relations for the articles', false);
$GLOBALS['plugin']->addTable('articles_set','catalog_articles_set','articlesets for the articles', false);
$GLOBALS['plugin']->addTable('fields_values','catalog_articles_fields_values','Additional fields for the articles', false);
$GLOBALS['plugin']->addTable('fields_roles','catalog_articles_fields_roles','Role Permissions for the property', false);
$GLOBALS['plugin']->addTable('fields_rel','catalog_articles_fields_rel','Additional fields for the articles', false);
$GLOBALS['plugin']->addTable('fields','catalog_articles_fields','Additional fields for the articles', false);
$GLOBALS['plugin']->addTable('images','catalog_articles_images','Images for the articles', false);
$GLOBALS['plugin']->addTable('tree','catalog_tree','Tree', false);
$GLOBALS['plugin']->addTable('nodes','catalog_tree_nodes','Tree nodes', false);
$GLOBALS['plugin']->addTable('tree2articles','catalog_tree_articles','Tree to articles', false);
$GLOBALS['plugin']->addTable('fieldgroups','catalog_fieldgroups','Field groups', false);
$GLOBALS['plugin']->addTable('fieldgroups_rel','catalog_fieldgroups_rel','Field groups relations', false);
$GLOBALS['plugin']->addTable('node_perms','node_perms','Node Permissions (Global)', false);

include_once('config.ext.inc.php');
if($GLOBALS['plugin']->module=='admin'){
include_once('config.admin.inc.php');
}

// Plugin admin tabs
$GLOBALS['plugin']->addTab('po','Property Fields','properties_overview.php',true,true);
$GLOBALS['plugin']->addTab('go','Property Groups','fieldgroups_overview.php',false,true);
$GLOBALS['plugin']->addTab('pe','tab:edit_property','properties_edit.php',false,false);
$GLOBALS['plugin']->addTab('ge','Edit fieldgroups','fieldgroups_edit.php',false,false);
$GLOBALS['plugin']->addTab('slave1','slave1','slave1.php',false,false);


// Permission Manager Popup
$GLOBALS['plugin']->addConfig('node_manager_tpl', 110, 'Template ID for the node manager popup');
$GLOBALS['plugin']->addConfig('node_manager_base_id', 150, 'Template ID for the node manager popup');

// Enable Permissions
$GLOBALS['plugin']->enablePermissions();

// Load license for the main catalog
if(function_exists("zend_loader_install_license")){
	@zend_loader_install_license(LICENCES_DIR . $GLOBALS['cfg']->get("system","order_nr") . "_ch.iframe.snode.catalog.zl",1);
}
?>
