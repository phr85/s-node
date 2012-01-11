<?php

$GLOBALS['plugin']->setBaseID(140);

$GLOBALS['plugin']->addTab('mUser','mUser','mUser.php',false,false);
$GLOBALS['plugin']->addTab('mRole','mRole','mRole.php',false,false);
$GLOBALS['plugin']->addTab('mGroup','mGroup','mGroup.php',false,false);

$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);
$GLOBALS['plugin']->addTab('s1User','s1User','s1User.php',false,false);
$GLOBALS['plugin']->addTab('s1Role','s1Role','s1Role.php',false,false);
$GLOBALS['plugin']->addTab('s1Group','s1Group','s1Group.php',false,false);



$GLOBALS['plugin']->enablePermissions();


$GLOBALS['plugin']->addContentType(3, "User");

?>
