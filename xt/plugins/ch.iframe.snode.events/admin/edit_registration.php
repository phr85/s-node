<?php
$address_id = XT::getSessionValue("address_id");

if (XT::getPermission("edit")) {
	$GLOBALS['plugin']->contribute('editreg_buttons','Save', 'saveRegistration','save.png','0');
	$GLOBALS['plugin']->contribute('editreg_buttons','Save and close', 'saveRegistrationAndClose','save.png','0');
}

$result = XT::query("
    SELECT
        title, 
        type, 
        firstName, 
        lastName, 
        email, 
        postalCode, 
        city, 
        street, 
        tel, 
        creation_date
    FROM
        " . XT::getTable("addresses") . "
    WHERE
        id='" . $address_id . "'
",__FILE__,__LINE__);
$addrInfo = $result->fetchRow();

$result = XT::query("
    SELECT
        id,
        event_id,
        address_id,
        fieldname as name,
        fieldvalue as value
    FROM
        " . XT::getTable("events_registrations_details") . "
    WHERE
        address_id='" . $address_id . "'
", __FILE__,__LINE__);

$fields = array();

while ($row = $result->fetchRow()) {
	$fields[$row['id']] = $row;
}

XT::assign("ADDRINFO", $addrInfo);
XT::assign("FIELDS", $fields);

$content = XT::build("edit_registration.tpl");
?>