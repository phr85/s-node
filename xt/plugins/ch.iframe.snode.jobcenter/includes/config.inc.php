<?php

// Set Base id
XT::setBaseID(1700);

// Tree Class
XT::loadClass("tree.class.php","ch.iframe.snode.filemanager");

// Plugin tables
XT::addTable('jobs');
XT::addTable('jobs_detail');
XT::addTable('jobs_applications');
XT::addTable('jobs_applications_attachments');
XT::addTable('jobs_applications_values');
XT::addTable('relations');
XT::addTable('category_tree');
XT::addTable('category_nodes');
XT::addTable('addresses');
XT::addTable('countries');
XT::addTable('countries_detail');
XT::addTable('countries_regions');
XT::addTable('files');
XT::addTable('files_details');
XT::addTable('files_rel');
XT::addTable('files_tree');
XT::addTable('files_tree_details');

// Plugin admin tabs
XT::addTab('overviewjobs','Overview','overview.php',true,true);
XT::addTab('editjob','Edit job','editJob.php',false,false);
XT::addTab('previewjob','Preview job','viewJob.php',false,false);
XT::addTab('overviewapplications','Job applications','applications.php',false,true);
XT::addTab('editapplication','Edit application','editApplication.php',false,false);
XT::addTab('slave1','Slave1','slave1.php',false,false);

// Add content types
XT::addContentType(1700, "Job");

// Addresspicker template
XT::addConfig("ADDR_PICKER_TPL", 281);

// Application main node
XT::addConfig('application_main_node', 5);

// Enable Permissions
XT::enablePermissions();

$display = array();

// relations
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.relations.zl")){
    $display['relations'] = true;
}

// properties
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.properties.zl")){
    $display['properties'] = true;
}

XT::assign("DISPLAY",$display);

?>