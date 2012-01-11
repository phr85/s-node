<?php
if($GLOBALS['plugin']->getValue('feed') == ''){
    $feed = 0;
}
else {
	$feed = 1;
}

$title = $GLOBALS['plugin']->getValue("title");

XT::query("
    DELETE FROM
        " . $GLOBALS['plugin']->getTable("newsmanager_tree_details") . "
    WHERE
        node_id =" . $GLOBALS['plugin']->getValue("node_id") . "
        AND lang = '" . $GLOBALS['plugin']->getValue("save_lang") . "'
    ",__FILE__,__LINE__);

XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable("newsmanager_tree_details") . "
    (
        node_id,
        title,
        description,
        lang,
        feed,
        active
    ) VALUES (
        " . $GLOBALS['plugin']->getValue("node_id") . ",
        '" . $title . "',
        '" . $GLOBALS['plugin']->getValue('description') . "',
        '" . $GLOBALS['plugin']->getValue("save_lang") . "',
        '" . $feed . "',
        '" . XT::getValue('active') . "'
    )
    ",__FILE__,__LINE__);

?>
