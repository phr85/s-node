<?php

/* Configuration */
/* Author: Ricardo de Sousa */

// Set Base id
$GLOBALS['plugin']->setBaseID(9100);

XT::addTable(XT::getParam('table_tree'));
XT::addTable("addresses");
    
// Plugin tables
$GLOBALS['plugin']->addTable('googlemaps','googlemaps','Main Googlemaps Table', false);
$GLOBALS['plugin']->addTable('googlemaps_entries','googlemaps_entries','Main Googlemaps Entries', false);
$GLOBALS['plugin']->addTable('googlemaps_lang','googlemaps_lang','Main Googlemaps Lang Table', false);
$GLOBALS['plugin']->addTable('googlemaps_entries_lang','googlemaps_entries_lang','Main Googlemaps Entries Lang Table', false);

// Plugin admin tabs
$GLOBALS['plugin']->addTab('overview','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('slave1','slave1','slave1.php',false,false);
$GLOBALS['plugin']->addTab('edit','Edit','edit.php',false,false);

// Picture picker
$GLOBALS['plugin']->addConfig("image_picker_base_id", 240, "");
$GLOBALS['plugin']->addConfig("image_picker_tpl", 597, "");
$GLOBALS['plugin']->addConfig("image_category_picker_tpl", 598, "");

// Addresspicker template
XT::addConfig("ADDR_PICKER_TPL", 281);

// Permission Manager Popup
$GLOBALS['plugin']->addConfig('node_manager_tpl', 110, 'Template ID for the node manager popup');
$GLOBALS['plugin']->addConfig('node_manager_base_id', 150, 'Template ID for the node manager popup');

// Enable Permissions
$GLOBALS['plugin']->enablePermissions();

// Content Type
$GLOBALS['plugin']->addContentType(9100,'Googlemap');

// After how many seconds is someone allowed to re-vote?
$GLOBALS['plugin']->addConfig('api-key', 'ABQIAAAAVIuWexKljUKQLeg5NPTTuRT-rO6uP5G6ENUSMTVSBwA3dxPO8xQpNb9Mapym6_8ThPR2N2TBZnp1qw');

?>