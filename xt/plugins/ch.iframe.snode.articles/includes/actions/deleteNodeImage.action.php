<?php

XT::call('saveNode');
XT::setAdminModule("en");

XT::query("
    UPDATE 
        " . XT::getTable("articles_tree_details") . "
    SET
        image=NULL,
        image_version=NULL
    WHERE
        node_id=" . XT::getValue("node_id") . " AND
        lang = '" .  $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);
?>
