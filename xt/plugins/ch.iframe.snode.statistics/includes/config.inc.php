<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(2600);

// Plugin tables
$GLOBALS['plugin']->addTable('tracking','tracking','Tracking table', false);
$GLOBALS['plugin']->addTable('navigation_details','navigation_details','Navigation details', false);
$GLOBALS['plugin']->addTable('tracking_archives','tracking_archives','Tracking table', false);
$GLOBALS['plugin']->addTable('years','statistics_years','Years', false);
$GLOBALS['plugin']->addTable('months','statistics_months','months', false);
$GLOBALS['plugin']->addTable('days','statistics_days','days', false);
$GLOBALS['plugin']->addTable('hosts_months','statistics_hosts_months','host_months', false);
$GLOBALS['plugin']->addTable('referer_months','statistics_referer_months','referer_months', false);
$GLOBALS['plugin']->addTable('views_months','statistics_views_months','views_months', false);
$GLOBALS['plugin']->addTable('agents_months','statistics_agents_months','agents_months', false);

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('v','View','view.php',false,false);

// Enable Permissions
$GLOBALS['plugin']->enablePermissions();
?>
