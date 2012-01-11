<?php
XT::addConfig("convert_user_button",false);
XT::addConfig("home_folder_id","2"); // used for securitycenter register
$GLOBALS['plugin']->addTable('files_tree','files_tree','File tree', false); // used for securitycenter register
$GLOBALS['plugin']->addTable('files_tree_details','files_tree_details','File tree', false);  // used for securitycenter register
?>