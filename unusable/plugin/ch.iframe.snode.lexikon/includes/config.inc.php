<?php
// Set Base id
$GLOBALS['plugin']->setBaseID(1800);

// Plugin tables
$GLOBALS['plugin']->addTable('shop_articles','shop_articles','product of month and present', false);

$GLOBALS['plugin']->addTable('articles_details','lexikon_articles_details','detail informations for the articles', false);
$GLOBALS['plugin']->addTable('articles_relations','lexikon_articles_relations','relations for the articles', false);
$GLOBALS['plugin']->addTable('articles_set','lexikon_articles_set','articlesets for the articles', false);
$GLOBALS['plugin']->addTable('fields','lexikon_articles_fields','Additional fields for the articles', false);
$GLOBALS['plugin']->addTable('fieldnames','lexikon_articles_fieldnames','Additional fields for the articles', false);
$GLOBALS['plugin']->addTable('images','lexikon_articles_images','Images for the articles', false);
$GLOBALS['plugin']->addTable('tree','lexikon_tree','Tree', false);
$GLOBALS['plugin']->addTable('nodes','lexikon_tree_nodes','Tree nodes', false);
$GLOBALS['plugin']->addTable('tree2articles','lexikon_tree_articles','Tree to articles', false);
$GLOBALS['plugin']->addTable('node_perms','node_perms','Node Permissions (Global)', false);


include_once('config.ext.inc.php');

// Plugin admin tabs

$GLOBALS['plugin']->addTab('bt','Browser','browser_tree.php',true,true);
$GLOBALS['plugin']->addTab('bn','Browser Nodes','browser_nodes.php',false,false);
$GLOBALS['plugin']->addTab('sa','Select Articles','select_articles.php',false,false);
$GLOBALS['plugin']->addTab('en','Edit node','edit_node.php',false,false);
$GLOBALS['plugin']->addTab('la','Articles','list_articles.php',false,true);
$GLOBALS['plugin']->addTab('ea','Edit articles','edit_articles.php',false,false);
if (XT::getPermission('manageProperties')){
$GLOBALS['plugin']->addTab('po','Property Fields','properties_overview.php',false,true);
}
$GLOBALS['plugin']->addTab('pe','tab:edit_property','properties_edit.php',false,false);
$GLOBALS['plugin']->addTab('slave1','slave1','slave1.php',false,false);


// Plugin config
$GLOBALS['plugin']->addConfig("use_related", false , "");


// Article picker
$GLOBALS['plugin']->addConfig("article_picker_base_id", $GLOBALS['plugin']->getBaseID() , "");
$GLOBALS['plugin']->addConfig("article_picker_tpl", 678, "");


// Picture picker
$GLOBALS['plugin']->addConfig("image_picker_base_id", 240, "");
$GLOBALS['plugin']->addConfig("image_picker_tpl", 597, "");

// Permission Manager Popup
$GLOBALS['plugin']->addConfig('node_manager_tpl', 110, 'Template ID for the node manager popup');
$GLOBALS['plugin']->addConfig('node_manager_base_id', 150, 'Template ID for the node manager popup');

// Enable Permissions
$GLOBALS['plugin']->enablePermissions();

// Content Type
$GLOBALS['plugin']->addContentType(10,'Lexikon');

?>
