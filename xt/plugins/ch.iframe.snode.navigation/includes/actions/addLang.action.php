<?php

// Add default language version
XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('navigation_details') . " (
        nav_id, 
        lang, 
        active, 
        creation_user, 
        creation_date, 
        mod_user, 
        mod_date 
    ) VALUES (
        " . $GLOBALS['plugin']->getValue("id") . ",
        '" . $GLOBALS['plugin']->getValue("lang") . "',
        0,
        " . $GLOBALS['auth']->getUserId() . ",
        " . time() . ",
        " . $GLOBALS['auth']->getUserId() . ",
        " . time() . "
)",__FILE__,__LINE__);

$GLOBALS['plugin']->setSessionValue("lang", $GLOBALS['plugin']->getValue("lang"));

// Set module to edit
$GLOBALS['plugin']->jumpTo('e');

?>
