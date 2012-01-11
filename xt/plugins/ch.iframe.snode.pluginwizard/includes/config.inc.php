<?php

$GLOBALS['plugin']->setBaseID(2100);

$GLOBALS['plugin']->addTab("s","Start","start.php",true,true);

$GLOBALS['plugin']->addTab("1_1","Plugin metadata","1_1.php",false,false);
$GLOBALS['plugin']->addTab("1_2","Administration","1_2.php",false,false);
$GLOBALS['plugin']->addTab("1_3","Datasources","1_3.php",false,false);
$GLOBALS['plugin']->addTab("1_4","Samples","1_4.php",false,false);

$GLOBALS['plugin']->addTabDoubleRelation("1_1","1_2");
$GLOBALS['plugin']->addTabDoubleRelation("1_1","1_3");
$GLOBALS['plugin']->addTabDoubleRelation("1_1","1_4");
$GLOBALS['plugin']->addTabDoubleRelation("1_2","1_3");
$GLOBALS['plugin']->addTabDoubleRelation("1_2","1_4");
$GLOBALS['plugin']->addTabDoubleRelation("1_3","1_4");

$GLOBALS['plugin']->enablePermissions();

?>
