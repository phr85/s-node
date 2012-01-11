<?php
$title = $GLOBALS['plugin']->getValue("title");

XT::query("
    DELETE FROM
        " . $GLOBALS['plugin']->getTable("files_tree_details") . "
    WHERE
        node_id =" . $GLOBALS['plugin']->getValue("node_id") . "
        AND lang = '" . $GLOBALS['plugin']->getValue("save_lang") . "'
    ",__FILE__,__LINE__);

XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable("files_tree_details") . "
    (
        node_id,
        title,
        description,
        lang,
        active,
        image,
        image_version
    ) VALUES (
        " . $GLOBALS['plugin']->getValue("node_id") . ",
        '" . $title . "',
        '" . $GLOBALS['plugin']->getValue('description') . "',
        '" . $GLOBALS['plugin']->getValue("save_lang") . "',
        '" . XT::getValue('active') . "',
        '" . XT::getValue('image') . "',
        '" . XT::getValue('image_version') . "'
    )
",__FILE__,__LINE__);

XT::loadClass('searchindex.class.php','ch.iframe.snode.search');
$search = new XT_SearchIndex(XT::getValue("node_id"),$GLOBALS['plugin']->getContentType("Filefolder"),$GLOBALS['plugin']->getValue('public'));
$search->add($GLOBALS['plugin']->getValue("description"), 1);
$search->build($GLOBALS['plugin']->getValue("title"), $GLOBALS['plugin']->getValue("description"));
?>