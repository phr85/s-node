<?php
$event_id = XT::getSessionValue("event_id");

XT::addImageButton('[e]xport as csv', 'exportCsv', 'registration_buttons', 'save.png',"0","","e");
XT::getButtons('registration_buttons','REGISTRATION_BUTTONS');

$result = XT::query("
    SELECT
        regs.address_id as id,
        addr.firstName, 
        addr.lastName, 
        addr.email_private, 
        addr.city, 
        addr.creation_date
    FROM 
        " . XT::getTable("events_registrations") . " as regs LEFT JOIN
        " . XT::getTable("addresses") . " as addr ON(addr.id=regs.address_id)
    WHERE
        event_id = " . $event_id
,__FILE__,__LINE__);

$data = XT::getQueryData($result);
XT::assign("REGISTRATIONS", $data);
XT::assign("ID",$event_id);
$content = XT::build("registrations.tpl");
?>