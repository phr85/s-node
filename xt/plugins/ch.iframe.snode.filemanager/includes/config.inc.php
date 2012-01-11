<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(240);

// Plugin tables
$GLOBALS['plugin']->addTable('user','user','Users', false);
$GLOBALS['plugin']->addTable('relations','relations','Relations', false);
$GLOBALS['plugin']->addTable('files_revision','files_revision','revision', false);
$GLOBALS['plugin']->addTable('content_types','content_types','content_types', false);
$GLOBALS['plugin']->addTable('search_infos_global','search_infos_global','search_infos_global', false);
$GLOBALS['plugin']->addTable('files','files','Files', false);
$GLOBALS['plugin']->addTable('files_details','files_details','Files lang infos', false);
$GLOBALS['plugin']->addTable('files_rel','files_rel','File tree', false);
$GLOBALS['plugin']->addTable('files_tree','files_tree','File tree', false);
$GLOBALS['plugin']->addTable('files_versions','files_versions','File versions', false);
$GLOBALS['plugin']->addTable('files_tree_details','files_tree_details','File tree', false);
$GLOBALS['plugin']->addTable('relations','relations','relations', false);
$GLOBALS['plugin']->addTable('node_perms','node_perms','relations', false);

// Plugin config variables
$GLOBALS['plugin']->addConfig('download_path', '/', 'The target path for download.php');
$GLOBALS['plugin']->addConfig('file_upload_dir', DATA_DIR . 'files/', 'The target folder for file uploads');
$GLOBALS['plugin']->addConfig('node_manager_tpl', 110, 'Template ID for the node manager popup');
$GLOBALS['plugin']->addConfig('node_manager_base_id', 150, 'Template ID for the node manager popup');

$GLOBALS['plugin']->addContentType(240, "File");
$GLOBALS['plugin']->addContentType(241, "Filefolder");

// Plugin admin tabs
$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);

$GLOBALS['plugin']->addTab('vf','View file','viewFile.php',false,false);
$GLOBALS['plugin']->addTab('er','Edit relation','editRelation.php',false,false);
$GLOBALS['plugin']->addTab('b','Browser','browser.php',false,false);
$GLOBALS['plugin']->addTab('afi','Add a file','addFile.php',false,false);
$GLOBALS['plugin']->addTab('en','Edit folder','edit_node.php',false,false);
$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);
$GLOBALS['plugin']->addTab('e','Edit','editFile.php',false,false);
$GLOBALS['plugin']->addTab('userfolder','User folders','userfolders.php',true,true);

// Load permissions
$GLOBALS['plugin']->enablePermissions();


// INFO: die Einstellungen die du vielleicht suchst sind in config.ext.inc.php drinn

// New folders per default as pulic or not
XT::addConfig("newfolderdefault",1);

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

XT::assign("DISPLAY",$display);


include_once('config.ext.inc.php');
include_once('config.special.ext.inc.php');
?>
