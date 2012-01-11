<?php

$result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable('groups') . " WHERE title = '" . $GLOBALS['plugin']->getValue("group_title") . "'",__FILE__,__LINE__);
$row = $result->FetchRow();

$result = XT::query("SELECT
        group_id
    FROM
        " . $GLOBALS['plugin']->getTable('tpl_group_perms') . "
    WHERE
        group_id = '" . $row['id'] . "'
        AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        AND node_id = '" . $GLOBALS['plugin']->getSessionValue('id') . "'
    ");

if($row['id'] > 0 && $result->RecordCount() <= 0){
    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('group_perms') . " (
            node_id,
            group_id,
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
    XT::log("Group doesn't exist",__FILE__,__LINE__,XT_ERROR);
}

?>