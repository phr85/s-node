<?php

// Load address entity class
XT::loadClass('address.class.php','ch.iframe.snode.addresses');

// Instantiate address entry
$address = new XT_Address();
$address->save();

XT::setValue("id",$address->getID());

XT::setSessionValue("View","edit");
?>