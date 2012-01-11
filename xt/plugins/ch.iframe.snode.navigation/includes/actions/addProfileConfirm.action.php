<?php

include_once(CLASS_DIR . 'nestedset.class.php');
include_once(CLASS_DIR . 'navigation.class.php');

$GLOBALS['plugin']->setAdminModule('ap');

if($GLOBALS['plugin']->getPostValue('profileName') == ""){
    XT::log("Profile name cannot be empty",__FILE__,__LINE__,XT_ERROR);
} else {
    $result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable('navigation') . " WHERE title = '" . $GLOBALS['plugin']->getPostValue('profileName') . "' LIMIT 1",__FILE__,__LINE__);
    while($row = $result->FetchRow()){
        XT::log("This profile name already exists",__FILE__,__LINE__,XT_ERROR);
    }
}

if(!XT::hasErrors()){
    $nestedset = new nestedset($GLOBALS['plugin']);
    $nestedset->setTable('navigation');
    $navigation = new navigation($GLOBALS['plugin']);
    $navigation->setNestedSet($nestedset);
    $new_id = $navigation->addProfile($GLOBALS['plugin']->getPostValue('profileName'));

    $GLOBALS['plugin']->setSessionValue("profile", $new_id);
    $GLOBALS['plugin']->setSessionValue("open", $new_id);
    $GLOBALS['plugin']->jumpTo('o');
}

?>
