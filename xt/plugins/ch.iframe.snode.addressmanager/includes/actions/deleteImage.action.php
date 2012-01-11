<?php

XT::setAdminModule('e');
XT::call("save");
// Load address entity class
XT::loadClass('address.class.php','ch.iframe.snode.addresses');

// Instantiate address entry
$address = new XT_Address(XT::getValue('id'));

// Update values
$address->setImage("");
// Commit changes
$address->save();
?>
