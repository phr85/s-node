<?php
// Delete the main newsletter
XT::loadClass('newsletter.class.php','ch.iframe.snode.newsletter');
$newsletter = new XT_Newsletter(XT::getValue('newsletter_id'));
$newsletter->delete();
// Delete all waiting mails for the newsletter
XT::query("DELETE FROM " . XT::getTable("newsletter_queue") . "  WHERE newsletter_id =  " . XT::getValue('newsletter_id'),__FILE__,__LINE__);
// Delete all sent mails for the newsletter because of the statistics
XT::query("DELETE FROM " . XT::getTable("newsletter_sent") . "  WHERE newsletter_id =  " . XT::getValue('newsletter_id'),__FILE__,__LINE__);
// Delete all views for the newsletter because of the statistics
XT::query("DELETE FROM " . XT::getTable("newsletter_views") . "  WHERE newsletter_id =  " . XT::getValue('newsletter_id'),__FILE__,__LINE__);
?>
