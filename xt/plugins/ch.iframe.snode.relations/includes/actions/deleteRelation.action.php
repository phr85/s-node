<?php
XT::setAdminModule("o");
$relation_id = XT::getValue("relation_id") == "" ? XT::getSessionValue("relation_id") : XT::getValue("relation_id");

XT::query("
    DELETE FROM
        " . XT::getTable("relations") . "
    WHERE
        id=" . $relation_id
,__FILE__,__LINE__);
?>