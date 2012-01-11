<?php

$GLOBALS['plugin']->setBaseID(210);

$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('e','Edit Header','editHeader.php',false,false);
$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);

$GLOBALS['plugin']->enablePermissions();

?>
