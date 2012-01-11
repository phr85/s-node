<?php

// Delete address entry
XT::loadClass('address.class.php','ch.iframe.snode.addresses');
$address = new XT_Address(XT::getValue('address_id'));
$address->delete();

?>