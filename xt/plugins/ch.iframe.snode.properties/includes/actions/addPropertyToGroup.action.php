<?php
XT::call("saveGroup");

$result = XT::query("
    INSERT INTO
        " . XT::getTable("prop2group") . "
        (group_id, property_id)
    VALUES
        (" . XT::getValue("group_id") . ", " . XT::getValue("property_id_add") . ")
",__FILE__,__LINE__);
?>