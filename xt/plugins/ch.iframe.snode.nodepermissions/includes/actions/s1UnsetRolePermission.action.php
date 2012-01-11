<?php
// Set principal type: 1 user, 2 group, 3 role
$principal_type = 3;

    // Delete previously defined permissions
    XT::query("
    DELETE FROM 
        " . $GLOBALS['cfg']->get("database", "prefix") . "node_perms 
    WHERE 
        base_id = " . $GLOBALS['plugin']->getSessionValue("base_id") . "
        AND node_id = " . $GLOBALS['plugin']->getSessionValue("node_id") . "
        AND principal_id = " . $GLOBALS['plugin']->getValue("role_id") . "
        AND principal_type = " . $principal_type . "
        AND lang = '" . $GLOBALS['plugin']->getValue("save_lang") . "'
    ",__FILE__,__LINE__);
?>
