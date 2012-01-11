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
$GLOBALS['plugin']->addTable('suchabo','catalog_searchabo','Suchabos', false);

// UNITS
$GLOBALS['plugin']->addTable('units'    ,'units'           ,'Units main table'     , false);
$GLOBALS['plugin']->addTable('units_det','units_details'   ,'Units details table'  , false);

// PKG_UNITS
$GLOBALS['plugin']->addTable('pkg_units'    ,'packaging_units'           ,'Packaging Units main table'     , false);
$GLOBALS['plugin']->addTable('pkg_units_det','packaging_units_details'   ,'Packaging Units details table'  , false);

// FOREIGN
$GLOBALS['plugin']->addTable('files','files','Main files table', false);
$GLOBALS['plugin']->addTable('files_rel','files_rel','Main files relation to nodes table', false);
$GLOBALS['plugin']->addTable('files_details','files_details','Main files relation to nodes table', false);
$GLOBALS['plugin']->addTable('files_versions','files_versions','Version files table', false);

include_once('config.ext.inc.php');
if($GLOBALS['plugin']->module=='admin'){
    include_once('config.admin.inc.php');
}

// Plugin admin tabs
$GLOBALS['plugin']->addTab('la','Articles','list_articles.php',true,true);
$GLOBALS['plugin']->addTab('ea','Edit articles','edit_articles.php',false,false);

$GLOBALS['plugin']->addTab('bt','Categories','browser_tree.php',false,true);
$GLOBALS['plugin']->addTab('bn','Browser Nodes','browser_nodes.php',false,false);
$GLOBALS['plugin']->addTab('sa','Select Articles','select_articles.php',false,false);
$GLOBALS['plugin']->addTab('sfa','Search Articles','search_articles.php',false,false);
$GLOBALS['plugin']->addTab('en','Edit node','edit_node.php',false,false);
$GLOBALS['plugin']->addTab('o','Statistics','overview.php',false,true);
$GLOBALS['plugin']->addTab('slave1','slave1','slave1.php',false,false);

// Article picker
$GLOBALS['plugin']->addConfig("article_picker_base_id", $GLOBALS['plugin']->getBaseID() , "");
$GLOBALS['plugin']->addConfig("article_picker_tpl", 147, "");


// Picture picker
$GLOBALS['plugin']->addConfig("image_picker_base_id", 240, "");
$GLOBALS['plugin']->addConfig("image_picker_tpl", 597, "");
$GLOBALS['plugin']->addConfig("image_category_picker_tpl", 598, "");

// Product of the month (set 0 for unlimited)
$GLOBALS['plugin']->addConfig('product_of_month', 4, 'ammount of products of month');

// Permission Manager Popup
$GLOBALS['plugin']->addConfig('node_manager_tpl', 110, 'Template ID for the node manager popup');
$GLOBALS['plugin']->addConfig('node_manager_base_id', 150, 'Template ID for the node manager popup');

// Enable Permissions
$GLOBALS['plugin']->enablePermissions();

// Content Type
$GLOBALS['plugin']->addContentType(1200,'Product');

?>
