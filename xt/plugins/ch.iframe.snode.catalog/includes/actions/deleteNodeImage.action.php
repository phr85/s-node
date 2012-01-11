<?php
XT::setAdminModule("en");
XT::query("
    UPDATE
        " . XT::getTable("nodes") . "
    SET
        image='',
        image_version=''
    WHERE
        node_id = " . $GLOBALS['plugin']->getValue("node_id") . "
    AND
        lang='" . $GLOBALS['plugin']->getValue("save_lang") . "'
",__FILE__,__LINE__)
?>