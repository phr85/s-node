<?php

XT::loadClass('newsletter.class.php','ch.iframe.snode.newsletter');
$newsletter = new XT_Newsletter();
XT::setValue('newsletter_id',$newsletter->create());
XT::setAdminModule('e');

?>
