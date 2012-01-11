<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(8400);

XT::addTable(XT::getParam('table_tree'));
    
// Plugin tables
$GLOBALS['plugin']->addTable('ratings','ratings','Main ratings table', false);
$GLOBALS['plugin']->addTable('ratings_votes','ratings_votes','Main ratings table', false);

// Plugin admin tabs
$GLOBALS['plugin']->addTab('overview','Overview','overview.php',true,true);

// Permission Manager Popup
$GLOBALS['plugin']->addConfig('node_manager_tpl', 110, 'Template ID for the node manager popup');
$GLOBALS['plugin']->addConfig('node_manager_base_id', 150, 'Template ID for the node manager popup');

// Enable Permissions
$GLOBALS['plugin']->enablePermissions();

// Content Type
$GLOBALS['plugin']->addContentType(8400,'Ratings');

// After how many seconds is someone allowed to rate again?
$GLOBALS['plugin']->addConfig('rateTime', 3600);

?>