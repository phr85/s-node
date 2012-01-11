<?php
XT::query("
    UPDATE
        " . XT::getTable("events_tree_details") . "
    SET
        active=1
    WHERE
        node_id=" . XT::getValue("node_id") . " AND
        lang='" . XT::getPluginLang() . "'
",__FILE__,__LINE__);
?>