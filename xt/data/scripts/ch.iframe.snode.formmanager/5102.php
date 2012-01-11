<?php
$comment=strip_tags($fields['gb_comment'][0],'<p><b><br />');
$name=strip_tags($fields['gb_name']);
$website=strip_tags($fields['gb_website']);
$email=strip_tags($fields['gb_email']);

XT::query("insert into `xt_guestbook`
  (
    `id`,
    `active`,
    `creation_date`,
    `creation_user`,
    `mod_date`,
    `mod_user`,
    `ip`,
    `name`,
    `email`,
    `website`,
    `comment`,
    `blockip`
) values (  
     '',  
     '0',
     '" . time() . "',  
     '0',  '0',  '0',  
     '" . $_SERVER['REMOTE_ADDR'] . "',  
     '" . $name . "',  
     '" . $email . "',  
     '" . $website . "',  
     '" . $comment . "',  
     '0' )",__FILE__,__LINE__,0);

// submodul umschalter auf liste (default)
unset($_SESSION['x1500']['mod']);

?> 