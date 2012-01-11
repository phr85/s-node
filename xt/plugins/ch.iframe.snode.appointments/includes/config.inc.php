<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(8300);

// Plugin tables
$GLOBALS['plugin']->addTable('appointments','appointments','Main appointments Table', false);
$GLOBALS['plugin']->addTable('appointments_entries','appointments_entries','Entries to the appointment', false);

// Plugin admin tabs
$GLOBALS['plugin']->addTab('overview','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('edit','Edit','edit.php',false,false);

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
$GLOBALS['plugin']->addContentType(8300,'Appointments');

// After how many seconds should an appointment get deleted?
$GLOBALS['plugin']->addConfig('deleteTime', 3000000);

// After how many seconds is someone allowed to post an appointment after having already posted one?
$GLOBALS['plugin']->addConfig('postTime', 1);

// Google Maps API Key for your domain
$GLOBALS['plugin']->addConfig('googleMapsKey', 'ABQIAAAAVIuWexKljUKQLeg5NPTTuRT-rO6uP5G6ENUSMTVSBwA3dxPO8xQpNb9Mapym6_8ThPR2N2TBZnp1qw');

?>