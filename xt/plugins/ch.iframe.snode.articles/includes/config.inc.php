<?php

// Plugin :: Base ID
XT::setBaseID(270);

// Plugin :: Tables
XT::addTable('articles');
XT::addTable('articles_tree_rel');
XT::addTable('articles_tree');
XT::addTable('articles_tree_details');
XT::addTable('articles_chapters');
XT::addTable('articles_v');
XT::addTable('articles_chapters_v');

XT::addTable('files');
XT::addTable('files_details');
XT::addTable('files_versions');

XT::addTable('navigation_contents','navigation_contents','Content table for page', false);
XT::addTable('navigation_details','navigation_details','Details table for page', false);
$GLOBALS['plugin']->addTable('plugins_packages','plugins_packages','List of packages', false);

// Plugin :: Administration :: Tabs
XT::addTab('o','Overview','overview.php',true,true);
if(XT::getPermission("list")){
XT::addTab('l','List','list.php',false,true);
}
XT::addTab('e','Edit','edit.php',false,false);
XT::addTab('t','Time','time.php',false,false);
XT::addTab('en','Edit folder','edit_node.php',false,false);
XT::addTab('slave1','slave1','slave1.php',false,false);
XT::addtab('search','Search','search.php',false,false);

// Plugin :: Configuration
XT::addConfig('admin_tpl', 606);
XT::addConfig('node_manager_tpl', 110, 'Template ID for the node manager popup');
XT::addConfig('node_manager_base_id', 150, 'Template ID for the node manager popup');
XT::addConfig("image_picker_base_id", 240, "");
XT::addConfig("image_picker_tpl", 597, "");
XT::addConfig("use_node_permissions", true);

// Plugin :: Global template assignments
XT::assign("IMAGE_POPUP_TPL", 160);
XT::assign("FILEMANAGER_BASEID", 240);

// Plugin :: Content Types
XT::addContentType(270, "Article");
XT::addContentType(271, "Article Category");
XT::addContentType(60, "Page");

// Plugin :: Enable Permissions
XT::enablePermissions();


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

// trackback
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.blog.zl")){
	$display['trackback']=true;
}

// text_element (old systems use true here)
$display['text']=false;
$display['convert']=false;

XT::assign("DISPLAY",$display);
?>