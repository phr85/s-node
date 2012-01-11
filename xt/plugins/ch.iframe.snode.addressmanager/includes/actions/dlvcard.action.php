<?php
XT::call("save");
XT::loadClass('vcard.class.php','ch.iframe.snode.addresses');
$vcard = new vCard(XT::getValue('id'));
$vcard->download();
?>