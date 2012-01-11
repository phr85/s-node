<?php

XT::setBaseID(4700);

XT::addTable('addresses');
XT::addTable('contacts');

XT::addTab('o','Overview','overview.php',true,true);

XT::enablePermissions();

?>