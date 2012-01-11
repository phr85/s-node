<?php

include_once(CLASS_DIR . 'nestedset.class.php');
$nestedset = new nestedset($GLOBALS['plugin']);
$nestedset->setTable('navigation');
$newid = $nestedset->insertBefore($GLOBALS['plugin']->getValue("target_id"));

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
        " . $newid . ",
        '" . $GLOBALS['plugin']->getSessionValue("lang_filter") . "',
        0,
        " . $GLOBALS['auth']->getUserId() . ",
        " . time() . ",
        " . $GLOBALS['auth']->getUserId() . ",
        " . time() . "
)",__FILE__,__LINE__);

// Create template file for this node
if(!file_exists(PAGES_DIR . $GLOBALS['plugin']->getValue("tpl_file"))){
    file_put_contents(PAGES_DIR . $GLOBALS['plugin']->getValue("tpl_file"), file_get_contents($GLOBALS['tpl']->template_dir . 'includes/skeleton.tpl'));
}

// Finish control operation
$GLOBALS['plugin']->unsetSessionValue("ctrl_add");

// Set new id as active and parent id as open
$GLOBALS['plugin']->setSessionValue("id", $newid);
$GLOBALS['plugin']->jumpTo("e");

?>
