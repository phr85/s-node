<?php

$GLOBALS['plugin']->setBaseID(1300);

// Add tables
$GLOBALS['plugin']->addTable("employees","employees","Main employees data");
$GLOBALS['plugin']->addTable("user","user","Users");
$GLOBALS['plugin']->addTable("customers","customers","Main customers data");
$GLOBALS['plugin']->addTable("customers_persons","customers_persons","Main persons data");
XT::addTable('countries');

// Add tabs
$GLOBALS['plugin']->addTab("pe","Persons","personsOverview.php",true,true);
$GLOBALS['plugin']->addTab("o","Companies","overview.php",false,true);
$GLOBALS['plugin']->addTab("ac","Add customer","addCustomer.php",false,false);
$GLOBALS['plugin']->addTab("ec","Edit customer","editCustomer.php",false,false);
$GLOBALS['plugin']->addTab("ep","Edit person","editPerson.php",false,false);

// Enable permissions
$GLOBALS['plugin']->enablePermissions();

?>
