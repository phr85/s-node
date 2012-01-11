<?php

$GLOBALS['plugin']->setBaseID(51000);


$GLOBALS['plugin']->addTable('virtual_url','virtual_url','', false);

$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);
$GLOBALS['plugin']->addTab('e','Edit','edit.php',false,false);

$GLOBALS['plugin']->enablePermissions();

?>