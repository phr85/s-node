<?php

$GLOBALS['plugin']->setBaseID(1000);

$GLOBALS['plugin']->addTable('areas','areas','',false);
$GLOBALS['plugin']->addTable('employees','employees','Main employees data', false);

$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('e','Edit','edit.php',false,false);
$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);

$GLOBALS['plugin']->enablePermissions();

?>