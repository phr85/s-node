<?php

include_once(CLASS_DIR . 'nestedset.class.php');
include_once(CLASS_DIR . 'navigation.class.php');

$nestedset = new nestedset($GLOBALS['plugin']);
$nestedset->setTable('navigation');

// delete node
$nestedset->deleteNode($GLOBALS['plugin']->getValue('id'));

// delete node details
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('navigation_details') . " WHERE nav_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

if(!XT::hasErrors()){
    $GLOBALS['plugin']->jumpTo('o');
}

?>
