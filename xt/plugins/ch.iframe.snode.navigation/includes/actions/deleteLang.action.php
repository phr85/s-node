<?php

// Set module and tab to edit
$GLOBALS['plugin']->setAdminModule('e');

// Delete language version
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('navigation_details') . " WHERE lang = '" . $GLOBALS['plugin']->getValue("lang") . "' AND nav_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

include_once(CLASS_DIR . 'navigation.class.php');
$navigation = new navigation($GLOBALS['plugin']);

$langs = $navigation->getLangsAvailableById($GLOBALS['plugin']->getValue("id"));
$lang_keys = array_keys($langs);

$GLOBALS['plugin']->setValue("lang", $lang_keys[0]);

?>
