<?php
// Set Base id
$GLOBALS['plugin']->setBaseID(5500);

if(XT::getParam('table_tree')!=""){
    XT::addTable(XT::getParam('table_tree'));
    XT::addTable(XT::getParam('table_nodes'));
    XT::addTable(XT::getParam('table_items'));
    XT::addTable(XT::getParam('table_items_relation'));
}


// Plugin tables
$GLOBALS['plugin']->addTable('tree','category_tree','Tree', false);
$GLOBALS['plugin']->addTable('nodes','category_nodes','Tree nodes', false);
$GLOBALS['plugin']->addTable('relations','relations','Tree relations', false);
$GLOBALS['plugin']->addTable('contenttypes','content_types','contenttypes', false);
$GLOBALS['plugin']->addTable('articles','articles','articles', false);
$GLOBALS['plugin']->addTable('articles_chapters','articles_chapters','articles_chapters', false);


// Plugin admin tabs
$GLOBALS['plugin']->addTab('cat','Categories','tree.php',true,true);
$GLOBALS['plugin']->addTab('ecat','Edit node','edit_node.php',false,false);
$GLOBALS['plugin']->addTab('slave1','slave1','slave1.php',false,false);
$GLOBALS['plugin']->addTab('rel','Relations','relations.php',false,false);


// Picture picker
$GLOBALS['plugin']->addConfig("image_picker_base_id", 240, "");
$GLOBALS['plugin']->addConfig("image_picker_tpl", 597, "");
$GLOBALS['plugin']->addConfig("image_category_picker_tpl", 598, "");

// Permission Manager Popup
$GLOBALS['plugin']->addConfig('node_manager_tpl', 110, 'Template ID for the node manager popup');
$GLOBALS['plugin']->addConfig('node_manager_base_id', 150, 'Template ID for the node manager popup');

// Enable Permissions
$GLOBALS['plugin']->enablePermissions();

// Content Type
$GLOBALS['plugin']->addContentType(5500,'Product');

?>
