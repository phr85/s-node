<?php
$GLOBALS['plugin']->setBaseID(4000);

// Plugin tables
$GLOBALS['plugin']->addTable('newsmanager','newsmanager','core table for newsmanager',false);
$GLOBALS['plugin']->addTable('newsmanager_tree_rel','newsmanager_tree_rel','core table for newsmanager',false);
$GLOBALS['plugin']->addTable('newsmanager_tree','newsmanager_tree','core table for newsmanager tree',false);
$GLOBALS['plugin']->addTable('newsmanager_tree_details','newsmanager_tree_details','core table for newsmanager tree',false);
$GLOBALS['plugin']->addTable('newsmanager_chapters','newsmanager_chapters','table for the chapters',false);
$GLOBALS['plugin']->addTable('newsmanager_v','newsmanager_v','core table for newsmanager',false);
$GLOBALS['plugin']->addTable('newsmanager_chapters_v','newsmanager_chapters_v','table for the chapters',false);
$GLOBALS['plugin']->addTable('files','files','Media details', false);
$GLOBALS['plugin']->addTable('files_versions','files_versions','Media details', false);

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('l','List','list.php',false,true);
$GLOBALS['plugin']->addTab('e','Edit','edit.php',false,false);
$GLOBALS['plugin']->addTab('t','Time','time.php',false,false);
$GLOBALS['plugin']->addTab('en','Edit folder','edit_node.php',false,false);
$GLOBALS['plugin']->addTab('slave1','slave1','slave1.php',false,false);

// Tab relations
$GLOBALS['plugin']->addTabDoubleRelation('e','t');

// Config vars
$GLOBALS['plugin']->addConfig('admin_tpl', 190, 'Template ID for the newsmanager administration');

$GLOBALS['plugin']->addConfig('feeds_dir', 'feeds/news/', 'Location of feeds');
$GLOBALS['plugin']->addConfig('feeds_templates_dir', 'includes/feeds/', 'Templates dir for Feeds');

$GLOBALS['plugin']->addConfig('feeds_generator', 'S-Node XT Content Management System - http://www.iframe.ch', 'Builder of feeds');
// Image picker
$GLOBALS['plugin']->addConfig("image_picker_base_id", 240, "");
$GLOBALS['plugin']->addConfig("image_picker_tpl", 597, "");

XT::assign("IMAGE_POPUP_TPL", 160);
XT::assign("FILEMANAGER_BASEID", 240);

// Add content types
$GLOBALS['plugin']->addContentType(4000, "News");

// Load permissions
$GLOBALS['plugin']->enablePermissions();

?>