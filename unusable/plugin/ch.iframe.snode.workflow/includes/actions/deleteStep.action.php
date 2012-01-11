<?php
XT::query("
    DELETE FROM
        " . $GLOBALS['plugin']->getTable("workflows") . "
    WHERE
        id = " . $GLOBALS['plugin']->getValue("step_id") . "
    ");

header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['tpl_id']);
?>
