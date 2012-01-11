<?php
// Set principal type: 1 user, 2 group, 3 role
$principal_type = 2;

    // Delete previously defined permissions
    XT::query("
    DELETE FROM 
        " . $GLOBALS['cfg']->get("database", "prefix") . "perms 
    WHERE 
        base_id = " . $GLOBALS['plugin']->getSessionValue("base_id") . "
        AND principal_id = " . $GLOBALS['plugin']->getValue("group_id") . "
        AND principal_type = " . $principal_type . "
        AND lang = '" . $GLOBALS['plugin']->getValue("save_lang") . "'
    ",__FILE__,__LINE__);
?>
