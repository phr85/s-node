<?php
/**
 * Table definitions used by contributions made from this plugin
 *
 */
$GLOBALS['plugin']->addTable('articles','catalog_articles','Description', false);

// property types
$prop = array();
$prop[0] = "text"; // for normal text input, descriptions
$prop[1] = "bool"; // true;false
$prop[2] = "number"; // for numbers
$prop[3] = "dropdown"; // 0|zero|default;2|two|defalut; ==> 2 is default
$prop[4] = "dropdown multiselect"; // 0|zero|default;2|two|defalut;3|tres;4|four|default ==> 2 + 4 are default
$prop[5] = "range of numbers"; // 100;40000
$prop[6] = "relation"; // target content type and id
$prop[7] = "multiple relation"; // 
$prop[8] = "single line text"; // for normal text input, descriptions
$prop[9] = "radio"; //
$prop[10] = "checkbox"; // for normal text input, descriptions
$prop[11] = "multiple text"; // fuer tabelarische darstellungen

$GLOBALS['plugin']->addConfig("propertytypes",$prop,"");

?>