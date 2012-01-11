<?php

// Set Base id
XT::setBaseID(1400);

// Plugin tables
XT::addTable('user','user','Users', false);
XT::addTable('relations','relations','Relations', false);
XT::addTable('content_types','content_types','content_types', false);
XT::addTable('search_infos_global','search_infos_global','search_infos_global', false);
XT::addTable('faq','faq','FAQ', false);
XT::addTable('faq_cat','faq_cat','FAQ Categories', false);
XT::addTable('faq2cat','faq2cat','FAQ Items To Categories', false);
XT::addTable('faq_tree','faq_tree','FAQ Tree', false);
XT::addTable('faq_tree_details','faq_tree_details','FAQ Tree Details', false);

// Plugin config variables
XT::addConfig('config_var', 'config_var_value', 'Config variable description');

// Plugin admin tabs
XT::addTab('overview','Overview','overview.php',true,true);
XT::addTab('categories','Categories','categories.php',false,true);
XT::addTab('edit','Edit FAQ','edit.php',false,false);
XT::addTab('slave1','Slave1','slave1.php',false,false);
XT::addTab('edit_cat','Edit Category','edit_cat.php',false,false);
XT::addTab('search','Search for FAQ','search.php',false,false);

// Picture picker
XT::addConfig("image_picker_base_id", 240, "");
XT::addConfig("image_picker_tpl", 597, "");
XT::addConfig("image_category_picker_tpl", 598, "");

// Add content types provided by this plugin
XT::addContentType(1400, "FAQ Article");
XT::addContentType(1401, "FAQ Category");

// Mail Addresses to be used when answering Questions
// First mail in this array will always be notified on a new question
$GLOBALS['plugin']->addConfig('answeraddresses',
     array(
     1 =>'bla@info.com',
     2 =>'test@info.com'

     ), 'Mail addresses that can be chosen as answer addresses');

// Permission Manager Popup
XT::addConfig('node_manager_tpl', 110, 'Template ID for the node manager popup');
XT::addConfig('node_manager_base_id', 150, 'Template ID for the node manager popup');

// Enable Permissions
XT::enablePermissions();

?>