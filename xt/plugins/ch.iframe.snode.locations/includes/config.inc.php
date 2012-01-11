<?php

// Base ID
XT::setBaseID(2000);

// Tables
XT::addTable('company_locations');
XT::addTable('countries');

// Administration Tabs
XT::addTab('o','Overview','overview.php',true,true);
XT::addTab('slave1','Slave1','slave1.php',false,false);
XT::addTab('e','Edit','edit.php',false,false);

// Add content types
XT::addContentType(2000, 'Company location');

// Enable plugin permissions
XT::enablePermissions();

?>
