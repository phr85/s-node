<?php
XT::query("update " . XT::getTable('newsletter') . " set 
 `mod_date`='" . TIME . "',  
 `mod_user`='" . XT::getUserID() . "',   
 `image`='',  
 `image_version`='' 
 where `id`='" . XT::getValue("newsletter_id") . "' ",__FILE__,__LINE__);
?>