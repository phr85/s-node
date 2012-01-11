<?php

$GLOBALS['plugin']->setBaseID(2200);

// Add tables
$GLOBALS['plugin']->addTable('relations','relations','Relations', false);
$GLOBALS['plugin']->addTable('content_types','content_types','content_types', false);
$GLOBALS['plugin']->addTable('search_infos_global','search_infos_global','search_infos_global', false);
$GLOBALS['plugin']->addTable("employees","employees","Main employees data");
$GLOBALS['plugin']->addTable("projects","projects","Main projects data");
$GLOBALS['plugin']->addTable("projects_members","projects_members","Projects members");
$GLOBALS['plugin']->addTable("projects_steps","projects_steps","Projects steps");
$GLOBALS['plugin']->addTable("customers","customers","Main customers data");
$GLOBALS['plugin']->addTable("customers_persons","customers_persons","Main persons data");

// Add tabs
$GLOBALS['plugin']->addTab("o","Overview","overview.php",true,true);
$GLOBALS['plugin']->addTab("vp","View Project","viewProject.php",false,false);
$GLOBALS['plugin']->addTab("pl","Planning","planning.php",false,true);
$GLOBALS['plugin']->addTab("e","Edit project","editProject.php",false,false);
$GLOBALS['plugin']->addTab("em","Edit member","editMember.php",false,false);
$GLOBALS['plugin']->addTab('er','Edit relation','editRelation.php',false,false);
$GLOBALS['plugin']->addTab("slave1","Slave1","slave1.php",false,false);

$GLOBALS['plugin']->addContentType(9, "Project");

// Enable permissions
$GLOBALS['plugin']->enablePermissions();

?>
