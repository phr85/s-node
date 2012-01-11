<?php

$title = $GLOBALS['plugin']->getValue("title");

XT::query("
    DELETE FROM
        " . $GLOBALS['plugin']->getTable("formreport_tree_details") . "
    WHERE
        node_id =" . $GLOBALS['plugin']->getValue("node_id") . "
        AND lang = '" . $GLOBALS['plugin']->getValue("save_lang") . "'
    ",__FILE__,__LINE__);

XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable("formreport_tree_details") . "
    (
        node_id,
        title,
        description,
        lang,
        active
    ) VALUES (
        " . $GLOBALS['plugin']->getValue("node_id") . ",
        '" . $title . "',
        '" . $GLOBALS['plugin']->getValue('description') . "',
        '" . $GLOBALS['plugin']->getValue("save_lang") . "',
        '" . XT::getValue('active') . "'
    )
    ",__FILE__,__LINE__);



?>
