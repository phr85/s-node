<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(8000);

XT::addTable(XT::getParam('table_tree'));
    
// Plugin tables
$GLOBALS['plugin']->addTable('poll','poll','Main Poll Table', false);
$GLOBALS['plugin']->addTable('answers','poll_answers','Poll Answers Table', false);
$GLOBALS['plugin']->addTable('entries','poll_entries','Poll Entries Table', false);

// Plugin admin tabs
$GLOBALS['plugin']->addTab('overview','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('slave1','slave1','slave1.php',false,false);
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
$GLOBALS['plugin']->addContentType(8000,'Poll');

// After how many seconds is someone allowed to re-vote?
$GLOBALS['plugin']->addConfig('revoteTime', 10);

?>