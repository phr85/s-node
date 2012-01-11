<?php

require_once(FUNC_DIR . 'basic.functions.php');

// Plugin base id
$GLOBALS['plugin']->setBaseID(60);

// Plugin tables
$GLOBALS['plugin']->addTable('navigation','navigation','Main navigation structure data', false);
$GLOBALS['plugin']->addTable('navigation_details','navigation_details','Detail navigation structure data', false);
$GLOBALS['plugin']->addTable('user','user','Main users data', false);
$GLOBALS['plugin']->addTable('groups','groups','Main group data', false);
$GLOBALS['plugin']->addTable('roles','roles','Main roles data', false);
$GLOBALS['plugin']->addTable('user_groups','user_groups','User -> group assignments', false);
$GLOBALS['plugin']->addTable('tpl_user_perms','tpl_user_perms','Template Permissions (User)', false);
$GLOBALS['plugin']->addTable('tpl_group_perms','tpl_group_perms','Template Permissions (Group)', false);
$GLOBALS['plugin']->addTable('tpl_role_perms','tpl_role_perms','Template Permissions (Roles)', false);
XT::addTable('navigation_templates');
XT::addTable('files');

$GLOBALS['plugin']->addTable('navigation_contents','navigation_contents','Content table for page', false);
$GLOBALS['plugin']->addTable('plugins_packages','plugins_packages','List of packages', false);
$GLOBALS['plugin']->addTable('plugins_packages_details','plugins_packages_details','List of packages', false);
$GLOBALS['plugin']->addTable('plugins_contents_details','plugins_contents_details','List of packages', false);
$GLOBALS['plugin']->addTable('plugins_modules','plugins_modules','List of modules', false);
$GLOBALS['plugin']->addTable('plugins_params','plugins_params','List of module params', false);
$GLOBALS['plugin']->addTable('plugins_params_details','plugins_params_details','List of module params', false);
$GLOBALS['plugin']->addTable('plugins_contents','plugins_contents','List of module params', false);
$GLOBALS['plugin']->addTable('plugins_contents_rel','plugins_contents_rel','List of module params', false);

// Plugin configuration
$GLOBALS['plugin']->addConfig('default_profile', 'Default', 'Defines the default site structure profile');
$GLOBALS['plugin']->addConfig('node_manager_tpl', 110, 'Template ID for the node manager popup');
$GLOBALS['plugin']->addConfig('node_manager_base_id', 150, 'Template ID for the node manager popup');
$GLOBALS['plugin']->addConfig('admin_tpl', 605, 'Template ID for the node manager popup');
$GLOBALS['plugin']->addConfig('article_viewer_tpl', 726, '');
$GLOBALS['plugin']->addConfig('articles_baseid', 270, '');
$GLOBALS['plugin']->addConfig('param_types', array('normal' => 0, 'query' => 1, 'configarray' => 2, 'userinput' => 3, 'popup' => 4, 'custom' => 5, 'scriptfile' => 6), 'Parameter types');

// Image picker
$GLOBALS['plugin']->addConfig("image_picker_base_id", 240, "");
$GLOBALS['plugin']->addConfig("image_picker_tpl", 597, "");

// Plugin content type contributions
$GLOBALS['plugin']->addContentType(60, "Page");


// Special permission settings, for single content permissions
//$GLOBALS['plugin']->removePermissionsOnSingleContent(array("managePermissions", "addProfiles"));

$GLOBALS['plugin']->addTab('o','Overview','overview.php',true,true);
$GLOBALS['plugin']->addTab('oa','Advanced','overview_advanced.php',false,true);

// Enable Permissions
$GLOBALS['plugin']->enablePermissions();


// Headimages
$display['headimage']=true;
$display['menuimages']=false;


// relations
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.relations.zl")){
    $display['relations']=true;
}

// properties
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.properties.zl")){
    $display['properties']=true;
	XT::addConfig('display_properties', true, '');
    // use universal properties
    $display['properties_universal']=true;
}


XT::assign("DISPLAY",$display);

// Plugin admin tabs
$GLOBALS['plugin']->addTab('ap','Add profile','addProfile.php',false,false);
$GLOBALS['plugin']->addTab('ac','Add content','addContent.php',false,false);
$GLOBALS['plugin']->addTab('acs','Add content','addContent.php',false,false);
$GLOBALS['plugin']->addTab('a','Add page','addPage.php',false,false);
$GLOBALS['plugin']->addTab('e','Edit page','editPage.php',false,false);
$GLOBALS['plugin']->addTab('ec','Edit content','editContent.php',false,false);
$GLOBALS['plugin']->addTab('ecs','Edit content','editContentSimple.php',false,false);
$GLOBALS['plugin']->addTab('es','Edit page','editPageSimple.php',false,false);
$GLOBALS['plugin']->addTab('et','Edit template','editTemplate.php',false,false);
$GLOBALS['plugin']->addTab('slave1','Slave1','slave1.php',false,false);
$GLOBALS['plugin']->addTabDoubleRelation('e','et');

// article tabs
$GLOBALS['plugin']->addTab('selcat','Select Category','selectArticleCategory.php',false,false);

?>