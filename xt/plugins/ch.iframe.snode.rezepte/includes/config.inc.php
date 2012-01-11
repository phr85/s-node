<?php
// Set Base id
$GLOBALS['plugin']->setBaseID(5700);

// Plugin tables
$GLOBALS['plugin']->addTable('rezepte','rezepte','Rezepttabelle', false);
$GLOBALS['plugin']->addTable('r_details','rezepte_details','detail informations', false);
$GLOBALS['plugin']->addTable('r2i','rezepte_r2ingredient','ingridients', false);
$GLOBALS['plugin']->addTable('i_details','rezepte_ingridients_details','ingridients', false);
$GLOBALS['plugin']->addTable('ingridients','rezepte_ingridients','ingridients', false);


$GLOBALS['plugin']->addTable('images','rezepte_images','Images for the recipe', false);
$GLOBALS['plugin']->addTable('tree','rezepte_tree','Tree', false);
$GLOBALS['plugin']->addTable('nodes','rezepte_tree_nodes','Tree nodes', false);
$GLOBALS['plugin']->addTable('r2tree','rezepte_r2tree','Tree to recipe', false);
$GLOBALS['plugin']->addTable('node_perms','node_perms','Node Permissions (Global)', false);


// UNITS
$GLOBALS['plugin']->addTable('units'    ,'units'           ,'Units main table'     , false);
$GLOBALS['plugin']->addTable('units_det','units_details'   ,'Units details table'  , false);

// FOREIGN
$GLOBALS['plugin']->addTable('files','files','Main files table', false);
$GLOBALS['plugin']->addTable('files_rel','files_rel','Main files relation to nodes table', false);
$GLOBALS['plugin']->addTable('files_details','files_details','Main files relation to nodes table', false);
$GLOBALS['plugin']->addTable('files_versions','files_versions','Version files table', false);

if($GLOBALS['plugin']->module=='admin'){
    include_once('config.admin.inc.php');
}

// Plugin admin tabs
$GLOBALS['plugin']->addTab('la','Recipes','list.php',true,true);
$GLOBALS['plugin']->addTab('ea','Edit recipe','edit_recipe.php',false,false);

$GLOBALS['plugin']->addTab('bt','Categories','browser_tree.php',false,true);
$GLOBALS['plugin']->addTab('bn','Browser Nodes','browser_nodes.php',false,false);
$GLOBALS['plugin']->addTab('sa','Select recipe','select_recipe.php',false,false);
$GLOBALS['plugin']->addTab('sfa','Search recipe','search_recipe.php',false,false);
$GLOBALS['plugin']->addTab('en','Edit node','edit_node.php',false,false);
$GLOBALS['plugin']->addTab('o','Statistics','overview.php',false,true);
$GLOBALS['plugin']->addTab('slave1','slave1','slave1.php',false,false);

// recipe picker
$GLOBALS['plugin']->addConfig("recipe_picker_base_id", $GLOBALS['plugin']->getBaseID() , "");
$GLOBALS['plugin']->addConfig("recipe_picker_tpl", 5720, "");


// Picture picker
$GLOBALS['plugin']->addConfig("image_picker_base_id", 240, "");
$GLOBALS['plugin']->addConfig("image_picker_tpl", 597, "");
$GLOBALS['plugin']->addConfig("image_category_picker_tpl", 598, "");


// Multiple ingredients per recipe
$GLOBALS['plugin']->addConfig("multiingredient", true, "");

// Product of the month (set 0 for unlimited)
$GLOBALS['plugin']->addConfig('recipe_of_month', 4, 'ammount of products of month');

// Permission Manager Popup
$GLOBALS['plugin']->addConfig('node_manager_tpl', 110, 'Template ID for the node manager popup');
$GLOBALS['plugin']->addConfig('node_manager_base_id', 150, 'Template ID for the node manager popup');

// Enable Permissions
$GLOBALS['plugin']->enablePermissions();

// Content Type
$GLOBALS['plugin']->addContentType(5700,'Recipe');

// email to be notified
$GLOBALS['plugin']->addConfig("notified_email", "info@iframe.ch", "");

?>