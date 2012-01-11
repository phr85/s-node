<?php

// Base ID
XT::setBaseID(4100);

// Tables
XT::addTable('galleries');
XT::addTable('galleries_rel');
XT::addTable('galleries_folder_rel');
XT::addTable('galleries_details');

XT::addTable('files');
XT::addTable('files_details');
XT::addTable('files_tree');
XT::addTable('files_tree_details');
XT::addTable('files_rel');

// Administration tabs
XT::addTab('o','Overview','overview.php',true,true);
XT::addTab('en','Edit gallery','editGallery.php',false,false);
XT::addTab('slave1','Slave1','slave1.php',false,false);
XT::addTab('ai','Add images','addImages.php',false,false);

// Content type
XT::addContentType(4100, 'Gallery');

// Configuration
XT::addConfig('node_manager_tpl', 110, 'Template ID for the node manager popup');
XT::addConfig('node_manager_base_id', 150, 'Template ID for the node manager popup');
XT::addConfig('imageversions',
     array(
     0 =>'Thumbnail', 
     1 =>'Default', 
     2 =>'Small', 
     3 =>'Medium', 
     4 =>'Big'
     ), 'Image Versions');
     
// relations
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.relations.zl")){
    $display['relations']=true;
}

// properties
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.properties.zl")){
    $display['properties']=true;
    XT::addConfig('display_properties', true, '');
    // use universal properties
    $display['properties_universal']=false;
}

// Enable Permissions
XT::enablePermissions();

XT::assign("DISPLAY",$display);
?>