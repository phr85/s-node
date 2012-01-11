<?php
$result = XT::query("
    DELETE FROM
        " . XT::getTable("fieldgroups") . "
    WHERE
        id=" . XT::getValue("fieldgroup_id")
,__FILE__,__LINE__);

$result = XT::query("
    DELETE FROM
        " . XT::getTable("fieldgroups_rel") . "
    WHERE
        fieldgroup_id=" . XT::getValue("fieldgroup_id") 
,__FILE__,__LINE__);
?>