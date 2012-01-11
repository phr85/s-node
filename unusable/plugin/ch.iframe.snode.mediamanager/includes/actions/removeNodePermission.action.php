<?php

if($GLOBALS['plugin']->getValue("perm_id") != '' && $GLOBALS['plugin']->getSessionValue("node_id") != '' && $GLOBALS['plugin']->getActiveLang() != ''){
    XT::query("
        DELETE FROM
            " . $GLOBALS['plugin']->getTable($GLOBALS['plugin']->getSessionValue("perm_mode") . '_perms') . "
        WHERE
            user_id = '" . $GLOBALS['plugin']->getValue("perm_id") . "'
            AND node_id = '" . $GLOBALS['plugin']->getSessionValue("node_id") . "'
            AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    ");

    header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['tpl_id']);
}

?>