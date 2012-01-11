<?php

	// Set Maps API key
	XT::addConfig("key","ABQIAAAAzsQgAraedoQ0iLtU3UoBpBRXOyrdeTyf6c28WuREa1OaB5p1rBQj-l_CHT1f7eczYWrQdcOH4gTzUw");

	// Set Base id
	XT::setBaseID(7000);

	// Plugin tables
	XT::addTable('gmap');

	$GLOBALS['plugin']->addContentType(7000, "Google Map");

	// Plugin admin tabs
	$GLOBALS['plugin']->addTab('overview','Overview','overview.php',true,true);
	$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);
	$GLOBALS['plugin']->addTab('edit','edit map','edit.php',false,false);

	// Load permissions
	$GLOBALS['plugin']->enablePermissions();

?>