<?php
XT::call("saveGroup");

$result = XT::query("
    DELETE FROM
        " . XT::getTable("prop2group") . "
    WHERE
        group_id = " . XT::getValue("group_id") . " AND
        property_id = " . XT::getValue("property_id") . "
",__FILE__,__LINE__);
?>