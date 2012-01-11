<?php
$event_id = XT::getValue("id");

XT::query("
    DELETE FROM
        " . XT::getTable("events") . "
    WHERE
        id=" . $event_id 
,__FILE__,__LINE__);

XT::query("
    DELETE FROM
        " . XT::getTable("events_details") . "
    WHERE
        id=" . $event_id 
,__FILE__,__LINE__);

XT::query("
    DELETE FROM
        " . XT::getTable("events_tree_rel") . "
    WHERE
        event_id=" . $event_id
,__FILE__,__LINE__);

?>
