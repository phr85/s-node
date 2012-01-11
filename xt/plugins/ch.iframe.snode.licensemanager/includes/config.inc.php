<?php

$GLOBALS['plugin']->setBaseID(1900);

$GLOBALS['plugin']->addTable('licenses','licenses','',false);
$GLOBALS['plugin']->addTable('catalog_articles_details','catalog_articles_details','',false);

$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('e','Edit','editLicense.php',false,false);
$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);

$GLOBALS['plugin']->enablePermissions();

?>