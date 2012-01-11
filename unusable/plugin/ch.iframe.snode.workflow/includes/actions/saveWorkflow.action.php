<?php
/**
 * Saves a workflow
 */
XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable("workflows") . "
    SET
        title = '" . $GLOBALS['plugin']->getValue("title") . "',
        description = '" . $GLOBALS['plugin']->getValue("description") . "'
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("id") . "
    ");

header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['tpl_id']);

?>
