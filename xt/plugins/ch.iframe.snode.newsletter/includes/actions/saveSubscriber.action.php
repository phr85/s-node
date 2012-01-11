<?php

$categories = XT::getValue('categories');


// insert new categories
if(is_array($categories)){
    foreach ($categories as $val) {
        XT::query("INSERT into " . XT::getTable('newsletter_subscr2cat') . " ( `category_id`, `subscription_id` )
	 values (  '" . $val . "',  '" . XT::getValue('subscriber_id') . "')",__FILE__,__LINE__);
    }
}

$result = XT::query("
UPDATE 
" . XT::getDatabasePrefix() . "newsletter_subscriptions 
SET 
  email= '" . XT::getValue('email') . "',
  title= '" . XT::getValue('title') . "',
  anrede= '" . XT::getValue('anrede') . "',
  name= '" . XT::getValue('name') . "',
  firstname= '" . XT::getValue('firstname') . "',
  lastname= '" . XT::getValue('lastname') . "',
  company= '" . XT::getValue('company') . "',
  mobile= '" . XT::getValue('mobile') . "',
  lang='" . XT::getValue('lang') . "'  
WHERE
  id=" . XT::getValue('subscriber_id')

,__FILE__,__LINE__);

?>