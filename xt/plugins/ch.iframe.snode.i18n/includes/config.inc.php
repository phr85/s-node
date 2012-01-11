<?php

$GLOBALS['plugin']->setBaseID(30);

// Administration tabs
$GLOBALS['plugin']->addTab('l','Languages','languages.php',true,true);
$GLOBALS['plugin']->addTab('c','Countries','countries.php',true,true);
$GLOBALS['plugin']->addTab('r','Regions','regions.php',true,true);

// Used tables
$GLOBALS['plugin']->addTable('languages','languages','Languages',false);
$GLOBALS['plugin']->addTable('languages_translations','languages_translations','Languages (Translations)',false);
$GLOBALS['plugin']->addTable('countries','countries','Countries',false);
$GLOBALS['plugin']->addTable('regions','countries_regions','Regions',false);
$GLOBALS['plugin']->addTable('geo','ip_geo','IP to country Table',false);

// Enable Permissions
$GLOBALS['plugin']->enablePermissions();

?>
