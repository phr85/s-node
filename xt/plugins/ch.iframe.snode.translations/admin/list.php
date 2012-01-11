<?php

// Get package id (e.g. ch.iframe.snode.translations)
if(XT::getValue("package_id") != ''){
    XT::setSessionValue("package_id", XT::getValue("package_id"));
}

// Get package title (e.g. Translations)
if(XT::getValue("package_title") != ''){
    XT::setSessionValue("package_title", XT::getValue("package_title"));
}

// Add buttons
XT::addImageButton('<u>A</u>dd expression','addExpression','default','add.png','0','slave2','a');

// Get language file
$plugin_messages = array();
$keys = array();

if(XT::getSessionValue('package_id') == 'global' && is_file(ROOT_DIR . '/includes/lang/de.lang.php')){
    include(ROOT_DIR . '/includes/lang/de.lang.php');
    $keys = array_keys($messages['de']);
    
}
if(is_file(PLUGIN_DIR . XT::getSessionValue('package_id') . '/includes/lang/de.lang.php')){
    include(PLUGIN_DIR . XT::getSessionValue('package_id') . '/includes/lang/de.lang.php');
    $keys = array_keys($plugin_messages['de']);
}

// Handle order requests
if(XT::getValue("order_by_dir") != ''){
    XT::setSessionValue("order_by_dir", XT::getValue("order_by_dir"));
}
if(XT::getSessionValue('order_by_dir') != ''){
    if(strtolower(XT::getSessionValue('order_by_dir')) == 'asc'){
        usort($keys, create_function('$a,$b','return strcasecmp($a,$b);'));
    } else {
        usort($keys, create_function('$a,$b','return strcasecmp($b,$a);'));
    }
} else {
    usort($keys, create_function('$a,$b','return strcasecmp($a,$b);'));
    XT::setSessionValue('order_by_dir','asc');
}

foreach ($keys as $key => $value) {
	$keys[$key] = addslashes($value);
}

XT::assign("EXPRESSIONS", $keys);
XT::assign("PACKAGE_TITLE", XT::getSessionValue('package_title'));
XT::assign("ORDER_BY_DIR", XT::getSessionValue('order_by_dir'));

$content = XT::build('list.tpl');

?>