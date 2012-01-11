<?php

// Add an address entry
XT::loadClass('address.class.php','ch.iframe.snode.addresses');
$address = new XT_Address();
$address->setType(XT_ADDRESS_ORGANIZATION);
$address->setGender(XT_ADDRESS_MALE);
$address->setCountry('CH');
$address->save();

// Set the new id
XT::setValue("address_id",$address->getID());

// Move to edit mode
XT::setAdminModule('e');

?>