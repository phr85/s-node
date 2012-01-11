<?php

/**
 * Plugin call examples
 *
 * {plugin package=news module=main orientation=horizontal}<br>
 * {plugin package=mediamanager module=simpleimage picture=189 show_desc=1 show_details=1}
 * {plugin package=mediamanager module=imagegallery folder=4 version="Thumbnail" per_page=12 per_line=4 show_desc=0}
 * {plugin package=mediamanager module=randomimage folder=4 version="Default"}
 */

// Set Base id
$GLOBALS['plugin']->setBaseID(0000);

// Plugin tables
$GLOBALS['plugin']->addTable('media','media','Media elements', false);
$GLOBALS['plugin']->addTable('tree','media_tree','Media tree', false);
$GLOBALS['plugin']->addTable('versions','media_versions','Media versions', false);
$GLOBALS['plugin']->addTable('folders','media_folders','Media folder details', false);

$GLOBALS['plugin']->addTable('node_perms','node_perms','Tree node permissions', false);

// Plugin config variables
$GLOBALS['plugin']->addConfig('picture_upload_dir', ROOT_DIR . '/public_html/pictures/', 'The target folder for picture uploads');
$GLOBALS['plugin']->addConfig('node_manager_tpl', 110, 'Template ID for the node manager popup');
$GLOBALS['plugin']->addConfig('node_manager_base_id', 150, 'Template ID for the node manager popup');

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('np','Node permissions','node_perms.php',false,false);
$GLOBALS['plugin']->addTab('ap','Add pic','addPic.php',false,false);
$GLOBALS['plugin']->addTab('af','Add folder','addFolder.php',false,false);
$GLOBALS['plugin']->addTab('ef','Edit folder','editFolder.php',false,false);

// Add content types provided by this plugin
$GLOBALS['plugin']->addContentType(1, "Image");

$GLOBALS['plugin']->enablePermissions();

// Plugin specific
XT::loadClass('image.class.php','ch.iframe.snode.filemanager');
global $image;
$image = new XT_Image(&$GLOBALS['plugin']);

$image->addVersion(0, 'Thumbnail', 64, 64);
$image->addVersion(1, 'Default', 256, 256);
$image->addVersion(2, 'Small', 128, 128);
$image->addVersion(3, 'Big', 400, 400);

//$image->addEffectToVersion('Default', 'rotate', 90);
?>