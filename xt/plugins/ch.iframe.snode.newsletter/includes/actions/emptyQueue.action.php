<?php
 // Delete the record for a newsletter
XT::query("DELETE FROM " . XT::getTable("newsletter_queue") . "  WHERE newsletter_id =  " . XT::getValue('newsletter_id'),__FILE__,__LINE__);
 XT::log(XT::translate('Queue deleted for the newsletter' ) . " " . XT::getValue('newsletter_id') ,__FILE__,__LINE__,XT_WARNING);
?>