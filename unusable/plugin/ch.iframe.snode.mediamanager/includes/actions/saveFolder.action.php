<?php

$title = $GLOBALS['plugin']->getValue("title");

if($title != ''){

    $result = XT::query("
        SELECT
            a.id
        FROM
            " . $GLOBALS['plugin']->getTable("tree") . " as a,
            " . $GLOBALS['plugin']->getTable("tree") . " as b,
            " . $GLOBALS['plugin']->getTable("folders") . " as f
        WHERE
            b.id = " . $GLOBALS['plugin']->getValue("node_id") . "
            AND a.level = b.level + 1
            AND f.title = '" . $title . "'
            AND f.lang = '" . $GLOBALS['plugin']->getValue("save_lang") . "'
        ",__FILE__,__LINE__,0);

    if($result->RecordCount() < 1){

        XT::query("
            DELETE FROM
                " . $GLOBALS['plugin']->getTable("folders") . "
            WHERE
                node_id =" . $GLOBALS['plugin']->getValue("node_id") . "
                AND lang = '" . $GLOBALS['plugin']->getValue("save_lang") . "'
            ",__FILE__,__LINE__);

        XT::query("
            INSERT INTO
                " . $GLOBALS['plugin']->getTable("folders") . "
            (
                node_id,
                title,
                description,
                lang
            ) VALUES (
                " . $GLOBALS['plugin']->getValue("node_id") . ",
                '" . $title . "',
                '" . $GLOBALS['plugin']->getValue('description') . "',
                '" . $GLOBALS['plugin']->getValue("save_lang") . "'
            )
            ",__FILE__,__LINE__);

            //XT::log("Folder successfully saved",__FILE__,__LINE__,XT_INFO);

    } else {
        XT::log("Folder already exists",__FILE__,__LINE__,XT_ERROR);
    }

} else {
    XT::log("Folder name cannot be empty",__FILE__,__LINE__,XT_ERROR);
}

?>
