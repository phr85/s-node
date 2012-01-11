<?php
XT::setAdminModule("en");
XT::query("
    UPDATE
        " . XT::getTable("nodes") . "
    SET
        image='',
        image_version=''
    WHERE
        node_id = " . XT::getValue("node_id") . "
    AND
        lang='" . XT::getPluginLang() . "'
",__FILE__,__LINE__)
?>