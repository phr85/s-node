<?php
$title = $GLOBALS['plugin']->getValue("title");
if($title != ''){
    $result = XT::query("
        SELECT
            count(node_id) as nodes
        FROM
            " . $GLOBALS['plugin']->getTable("forum_categories_details") . "
        WHERE
            node_id = " . $GLOBALS['plugin']->getValue("node_id") . "
        AND
            lang='" . $GLOBALS['plugin']->getActiveLang() . "'
        ",__FILE__,__LINE__);

     $count = XT::getQueryData($result);

     if($count[0]['nodes'] ==0){
        XT::query("INSERT INTO
                        " . $GLOBALS['plugin']->getTable("forum_categories_details") . "
                        (node_id, lang)
                    VALUES
                        (" . $GLOBALS['plugin']->getValue("node_id") . ", '" . $GLOBALS['plugin']->getActiveLang() . "')"
                   ,__FILE__,__LINE__);
    XT::log("New Node details created in lang " . $GLOBALS['plugin']->getValue("save_lang"),__FILE__,__LINE__,XT_INFO);
     }

    XT::query("
        UPDATE
            " . $GLOBALS['plugin']->getTable("forum_categories_details") . "
        SET
            title = '" . $GLOBALS['plugin']->getValue("title") . "',
            description = '" . $GLOBALS['plugin']->getValue('description') . "',
            image='" . XT::getValue("image") . "',
            image_version='" . XT::getValue("image_version") ."'
        WHERE
            node_id = " . $GLOBALS['plugin']->getValue("node_id") . "
        AND
            lang='" . $GLOBALS['plugin']->getActiveLang() . "'
        ",__FILE__,__LINE__);


} else {
    XT::log("Node name cannot be empty",__FILE__,__LINE__,XT_ERROR);
}

$GLOBALS['plugin']->setAdminModule('ec');
?>
