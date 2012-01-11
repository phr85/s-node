<?php
XT::setAdminModule("ge");
$result = XT::query("
    DELETE FROM
        " . XT::getTable("fieldgroups_rel") . "
    WHERE
        fieldgroup_id = " . XT::getSessionValue("fieldgroup_id") . " AND
        field_id = " . XT::getValue("field_id")
,__FILE__,__LINE__);
?>