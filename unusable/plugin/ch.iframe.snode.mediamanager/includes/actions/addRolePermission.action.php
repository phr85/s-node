<?php

$result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable('roles') . " WHERE title = '" . $GLOBALS['plugin']->getValue("role_title") . "'",__FILE__,__LINE__);
$row = $result->FetchRow();

$result = XT::query("SELECT
        role_id
    FROM
        " . $GLOBALS['plugin']->getTable('role_perms') . "
    WHERE
        role_id = '" . $row['id'] . "'
        AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        AND node_id = '" . $GLOBALS['plugin']->getSessionValue('id') . "'
    ");

if($row['id'] > 0 && $result->RecordCount() <= 0){
    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('role_perms') . " (
            node_id,
            role_id,
            rights,
            lang
        ) VALUES (
            " . $GLOBALS['plugin']->getSessionValue('id') . ",
            " . $row['id'] . ",
            1,
            '" . $GLOBALS['plugin']->getActiveLang() . "'
    )",__FILE__,__LINE__);

    $GLOBALS['plugin']->setSessionValue('perm_id', $row['id']);

    header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['tpl_id']);
} else {
    XT::log("Role doesn't exist",__FILE__,__LINE__,XT_ERROR);
}

?>