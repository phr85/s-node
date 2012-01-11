<?php

$result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable('user') . " WHERE username = '" . $GLOBALS['plugin']->getValue("username") . "'",__FILE__,__LINE__);
$row = $result->FetchRow();

$result = XT::query("SELECT
        user_id
    FROM
        " . $GLOBALS['plugin']->getTable('tpl_user_perms') . "
    WHERE
        user_id = '" . $row['id'] . "'
        AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        AND node_id = '" . $GLOBALS['plugin']->getSessionValue('id') . "'
    ");

if($row['id'] > 0 && $result->RecordCount() <= 0){
    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('user_perms') . " (
            node_id,
            user_id,
            rights,
            lang
        ) VALUES (
            " . $GLOBALS['plugin']->getSessionValue('id') . ",
            " . $row['id'] . ",
            1,
            '" . $GLOBALS['plugin']->getActiveLang() . "'
    )",__FILE__,__LINE__);

    $GLOBALS['plugin']->setSessionValue('perm_id', $row['id']);

    header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['node_id']);
}

?>