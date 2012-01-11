<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(8600);

// Plugin tables
$GLOBALS['plugin']->addTable('regions'    ,'regions'   ,'Regionen'   , false);
$GLOBALS['plugin']->addTable('countries','countries'   ,'countries'  , false);


// Enable Permissions
$GLOBALS['plugin']->enablePermissions();
?>
