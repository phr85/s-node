<?php
XT::query("
    UPDATE
        " . XT::getTable("events_details") . "
    SET
        active=0
    WHERE
        id=" . XT::getValue("id") . " AND
        lang='" . XT::getPluginLang() . "'
",__FILE__,__LINE__);
?>