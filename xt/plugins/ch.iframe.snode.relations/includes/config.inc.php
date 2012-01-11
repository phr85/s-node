<?php
// Set baseID
XT::setBaseID(3700);

// Add tables
XT::addTable("relations");
XT::addTable("content_types");
XT::addTable("pickers");

// Add tabs
XT::addTab("o", "Overview", "overview.php", true, true);
XT::addTab("e", "Edit", "edit.php", false, false);
XT::addTab("n", "New", "new.php", false, false);
XT::addTab("slave1", "slave1", "slave1.php", false, false);

// Enable permissions
XT::enablePermissions();
?>