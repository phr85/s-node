<?php

XT::setBaseID(4500);

XT::addTable('addresses');
XT::addTable('countries_regions');
XT::addTable('countries');

XT::addTab('o','Overview','overview.php',true,true);
XT::addTab('e','Edit','edit.php',false,false);

XT::addContentType(4500,'Address');

// categories
$display['categories']=true;

XT::assign("DISPLAY",$display);

XT::enablePermissions();

?>