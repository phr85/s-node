<?php
XT::setAdminModule("ge");

$result = XT::query("
    INSERT INTO
        " . XT::getTable("fieldgroups_rel") . "
        (fieldgroup_id, field_id)
    VALUES
        (" . XT::getSessionValue("fieldgroup_id") . ", " . XT::getValue("property_id") . ")
",__FILE__,__LINE__);
?>