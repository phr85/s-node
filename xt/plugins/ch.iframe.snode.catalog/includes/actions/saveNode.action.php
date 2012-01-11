<?php
$title = $GLOBALS['plugin']->getValue("title");



// public_flag switch
if(XT::getValue("public")=="on"){
    $public = 1;
}else{
    $public = 0;
}


if($title != ''){
    $result = XT::query("
        SELECT
            count(node_id) as nodes
        FROM
            " . $GLOBALS['plugin']->getTable("nodes") . "
        WHERE
            node_id = " . $GLOBALS['plugin']->getValue("node_id") . "
        AND
            lang='" . $GLOBALS['plugin']->getValue("save_lang") . "'
        ",__FILE__,__LINE__);

     $count = XT::getQueryData($result);

     if($count[0]['nodes'] ==0){
        XT::query("INSERT INTO
                        " . $GLOBALS['plugin']->getTable('nodes') . "
                        (node_id, lang)
                    VALUES
                        (" . $GLOBALS['plugin']->getValue("node_id") . ", '" . $GLOBALS['plugin']->getValue("save_lang") . "')"
                   ,__FILE__,__LINE__);
    XT::log("New Node details created in lang " . $GLOBALS['plugin']->getValue("save_lang"),__FILE__,__LINE__,XT_INFO);
     }

    XT::query("
        UPDATE
            " . $GLOBALS['plugin']->getTable("nodes") . "
        SET
            title = '" . $GLOBALS['plugin']->getValue("title") . "',
            subtitle = '" . $GLOBALS['plugin']->getValue("subtitle") . "',
            description = '" . $GLOBALS['plugin']->getValue('description') . "',
            use_description = " . ($GLOBALS['plugin']->getValue('use_description') + 0) . ",
            image='" . XT::getValue("image") . "',
            image_version='" . XT::getValue("image_version") ."',
            public='" . $public ."'
        WHERE
            node_id = " . $GLOBALS['plugin']->getValue("node_id") . "
        AND
            lang='" . $GLOBALS['plugin']->getValue("save_lang") . "'
        ",__FILE__,__LINE__);


} else {
    XT::log("Node name cannot be empty",__FILE__,__LINE__,XT_ERROR);
}
$GLOBALS['plugin']->setAdminModule('en');
?>
