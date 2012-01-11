<?php
$title = $GLOBALS['plugin']->getValue("title");
if($title != ''){
  
    XT::query("
        UPDATE
            " . $GLOBALS['plugin']->getTable("forum_forums") . "
        SET
            title = '" . $GLOBALS['plugin']->getValue("title") . "',
            description = '" . $GLOBALS['plugin']->getValue('description') . "',
            image='" . XT::getValue("image") . "',
            image_version='" . XT::getValue("image_version") ."'
        WHERE
            id = " . $GLOBALS['plugin']->getValue("id") . "
         
        ",__FILE__,__LINE__);


} else {
    XT::log("Node name cannot be empty",__FILE__,__LINE__,XT_ERROR);
}

$GLOBALS['plugin']->setAdminModule('ef');
?>
