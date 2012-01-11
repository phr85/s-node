<?php
$title = XT::getValue("title");
if($title != ''){
    $result = XT::query("
        SELECT
            count(node_id) as nodes
        FROM
            " . XT::getTable("nodes") . "
        WHERE
            node_id = " . XT::getValue("node_id") . "
        AND
            lang='" . XT::getPluginLang() . "'
        ",__FILE__,__LINE__);

     $count = XT::getQueryData($result);

     if($count[0]['nodes'] ==0){
        XT::query("INSERT INTO
                        " . XT::getTable('nodes') . "
                        (node_id, lang)
                    VALUES
                        (" . XT::getValue("node_id") . ", '" . XT::getPluginLang() . "')"
                   ,__FILE__,__LINE__);
    XT::log("New Node details created in lang " . XT::getPluginLang(),__FILE__,__LINE__,XT_INFO);
     }

    XT::query("
        UPDATE
            " . XT::getTable("nodes") . "
        SET
            title = '" . XT::getValue("title") . "',
            subtitle = '" . XT::getValue("subtitle") . "',
            description = '" . XT::getValue('description') . "',
            use_description = " . (XT::getValue('use_description') + 0) . ",
            image='" . XT::getValue("image") . "',
            image_version='" . XT::getValue("image_version") ."'
        WHERE
            node_id = " . XT::getValue("node_id") . "
        AND
            lang='" . XT::getPluginLang() . "'
        ",__FILE__,__LINE__);


} else {
    XT::log("Node name cannot be empty",__FILE__,__LINE__,XT_ERROR);
}
$GLOBALS['plugin']->setAdminModule('en');
?>
