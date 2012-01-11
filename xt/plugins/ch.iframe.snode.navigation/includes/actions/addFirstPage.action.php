<?php

include_once(CLASS_DIR . 'nestedset.class.php');
$nestedset = new nestedset($GLOBALS['plugin']);
$nestedset->setTable('navigation');
$newid = $nestedset->insertNodeAtEnd($GLOBALS['plugin']->getSessionValue("profile"));

// Add default language version
XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('navigation_details') . " (
        nav_id,
        lang,
        active,
        tpl_file,
        creation_user,
        creation_date,
        mod_user,
        mod_date
    ) VALUES (
        " . $newid . ",
        '" . $GLOBALS['cfg']->get('lang','default') . "',
        0,
        '_pages/" . $newid . ".tpl',
        " . $GLOBALS['auth']->getUserId() . ",
        " . time() . ",
        " . $GLOBALS['auth']->getUserId() . ",
        " . time() . "
)",__FILE__,__LINE__);

// Create template file for this node
if(!file_exists(PAGES_DIR . '_pages/' . $newid . '.tpl')){
    file_put_contents(PAGES_DIR . '_pages/' . $newid . '.tpl', file_get_contents($GLOBALS['tpl']->template_dir . 'includes/skeleton.tpl'));
}

// Finish control operation
$GLOBALS['plugin']->unsetSessionValue("ctrl_add");

// Set new id as active and parent id as open
$GLOBALS['plugin']->setValue("id", $newid);
$GLOBALS['plugin']->setSessionValue("open", $GLOBALS['plugin']->getSessionValue("profile"));

$GLOBALS['plugin']->setAdminModule("e");

?>
