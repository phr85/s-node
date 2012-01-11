<?php


// Plugin :: Base ID wirs gesetzt
XT::setBaseID(7300);

// Plugin :: Tables  die tables der datenbank werden hier zugewiese welche in diesem plugin verfügbar sein müssen 
XT::addTable('forms');
XT::addTable('forms_elements');
XT::addTable('forms_elements_values');
XT::addTable('forms_fillouts');
XT::addTable('forms_data');
XT::addTable('formreport');
XT::addTable('formreport_tree_rel');
XT::addTable('formreport_tree');
XT::addTable('formreport_tree_details');
XT::addTable('navigation_contents','navigation_contents','Content table for page', false);
XT::addTable('navigation_details','navigation_details','Details table for page', false);


// Administration tabs werden hier erstellt 
XT::addTab('o',"Overview","overview.php",true,true);
XT::addTab('add','Add','add.php',false,false);
XT::addTab('slave1','Slave1','slave1.php',false,false);
XT::addTab('en','Edit folder','edit_node.php',false,false);
XT::addTab('h','Help','onlinehelp.php',false,false);
XT::addTab('a','Report','report.php',false,false);

// Administration tabs :: Relations

// Plugin :: Configuration
XT::addConfig('admin_tpl', 606);
XT::addConfig('node_manager_tpl', 110, 'Template ID for the node manager popup');
XT::addConfig('node_manager_base_id', 150, 'Template ID for the node manager popup');

// Plugin :: Global template assignments
XT::assign("IMAGE_POPUP_TPL", 160);

// Plugin :: Content Types
XT::addContentType(7300, "Form report");

XT::assign("DISPLAY",$display);
?>