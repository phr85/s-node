<?php

XT::query("DELETE FROM " . XT::getTable('fieldgroups') . " WHERE id=" . XT::getSessionValue("fieldgroup_id") . " AND lang='" . XT::getPluginLang() . "'",__FILE__,__LINE__);


 
$result = XT::query("
    INSERT INTO
        " . XT::getTable("fieldgroups") . "
        (id, lang, name, description) 
    VALUES 
        (" . XT::getSessionValue("fieldgroup_id") . ", '" . XT::getPluginLang()."', '" . addslashes(XT::getValue("name")) . "', '" . addslashes(XT::getValue("description")) . "')"
,__FILE__,__LINE__);

?>