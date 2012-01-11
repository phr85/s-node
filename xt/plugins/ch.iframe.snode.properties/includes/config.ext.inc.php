<?php
// Plugin tables
$GLOBALS['plugin']->addTable('node_perms','node_perms','Node Permissions (Global)', false);
$GLOBALS['plugin']->addTable('properties','properties','Main Table', false);
$GLOBALS['plugin']->addTable('details','properties_details','Detail Table', false);
$GLOBALS['plugin']->addTable('pgroups','properties_groups','Property Group Table', false);
$GLOBALS['plugin']->addTable('pgroups_details','properties_groups_details','Property Group Table', false);
$GLOBALS['plugin']->addTable('prop2group','properties_group2properties','Cross table prop 2 group', false);
$GLOBALS['plugin']->addTable('perms','properties_perms','Permission Table', false);
$GLOBALS['plugin']->addTable('values','properties_values','Data Table', false);
$GLOBALS['plugin']->addTable('content_types','content_types','Content types', false);


// property types
$prop = array();
$prop[0] = "text"; // for normal text input, descriptions
$prop[1] = "bool"; // true;false
$prop[2] = "number"; // for numbers
$prop[3] = "dropdown"; // 0|zero|default;2|two|defalut; ==> 2 is default
$prop[4] = "dropdown multiselect"; // 0|zero|default;2|two|defalut;3|tres;4|four|default ==> 2 + 4 are default
//$prop[5] = "range of numbers"; // 100;40000
$prop[6] = "relation"; // target content type and id
$prop[7] = "multiple relation"; //
$prop[8] = "single line text"; // for normal text input, descriptions
$prop[9] = "radio"; //
$prop[10] = "checkbox"; // for normal text input, descriptions
$prop[11] = "file / image"; // s-node file
$GLOBALS['plugin']->addConfig("propertytypes",$prop,"");

?>