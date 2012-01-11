<?php
$event_id = XT::getSessionValue("event_id");
$address_id = XT::getValue("id");

/*
XT::query("
    DELETE FROM 
        " . XT::getTable("addresses") . "
    WHERE
        id='" . $address_id . "'
",__FILE__,__LINE__);
*/

XT::query("
    DELETE FROM
       " . XT::getTable("events_registrations") . " 
    WHERE
        event_id='" . $event_id . "' AND
        address_id='" . $address_id . "'
",__FILE__,__LINE__);

XT::query("
    DELETE FROM
       " . XT::getTable("events_registrations_details") . " 
    WHERE
        event_id='" . $event_id . "' AND
        address_id='" . $address_id . "'
",__FILE__,__LINE__);

// count user
XT::query("update " . XT::getTable("events") . " set `reg_visitors`=reg_visitors-1
where `id`='" . $event_id . "'",__FILE__,__LINE__); 
?>