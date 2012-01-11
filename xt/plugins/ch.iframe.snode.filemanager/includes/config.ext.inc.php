<?php

XT::loadClass('image.class.php','ch.iframe.snode.filemanager');
global $image;
$image = new XT_Image($GLOBALS['plugin']);


// Plugin tables
$GLOBALS['plugin']->addTable('user','user','Users', false);
$GLOBALS['plugin']->addTable('relations','relations','Relations', false);
$GLOBALS['plugin']->addTable('content_types','content_types','content_types', false);
$GLOBALS['plugin']->addTable('search_infos_global','search_infos_global','search_infos_global', false);
$GLOBALS['plugin']->addTable('files','files','Files', false);
$GLOBALS['plugin']->addTable('files_details','files_details','Files lang infos', false);
$GLOBALS['plugin']->addTable('files_rel','files_rel','File tree', false);
$GLOBALS['plugin']->addTable('files_tree','files_tree','File tree', false);
$GLOBALS['plugin']->addTable('files_versions','files_versions','File versions', false);
$GLOBALS['plugin']->addTable('files_tree_details','files_tree_details','File tree', false);
$GLOBALS['plugin']->addTable('relations','relations','relations', false);


// Set the max file size in Kilobytes for the images.
// If the images is bigger than this size and destroy_original is true, the system takes the biggest image and overwrites the original.
// Bill gates: "640 kB ought to be enough for anybody."
XT::addConfig("max_image_size",640);

// Set the biggest possible image size for the original.
//If the destroy_original affected because the file size is to big.
//The original image is recalculated to this value to reduce the file size.
XT::addConfig("original_image_width",1024);

// ie. /usr/bin/convert
XT::addConfig("epsconverter","");

// Import files directory
define('IMPORT_DIR',BASE_DIR . '/imports');

$GLOBALS['plugin']->addConfig('image_quality', 82, 'Image Quality');

// Zoom image Version Default:5
// Set this Value in /xt/includes/config.template.inc.php and /xt/includes/config.inc.php

// Keep or Delete original images
XT::addConfig("destroy_original",false);

// Versions adn effects
include('config.version.inc.php');
foreach($image_versions as $key => $version) {
    $image->addVersion($key, $version['name'], $version['width'], $version['height'], $version['crop'], $version['bgcolor']);
    $pickernames[$key] = $version['name'];
    if(is_array($version['effects'])) {
        foreach($version['effects'] as $effect) {
            $image->addPrivateEffectToVersion($version['name'], $effect['name'], $effect['parameter']);
        }
    }
}

XT::assign("DEFAULT_IMAGE_VERSION",1);

// Versionarray is used for installer plugin and pickers
$GLOBALS['plugin']->addConfig('imageversions', $pickernames, 'Image Versions');

?>
