<?php
$category = XT::getValue('scategory_id');

// Bei Kategorie 0 alles l�schen ansonsten nur die subscriber_id aus der zuordnungstabelle l�schen

if($category!=0){
    XT::query("delete from " . XT::getTable('newsletter_subscr2cat') . " where
     `category_id`='" . $category . "' 
     AND 
     `subscription_id`='" . XT::getValue('subscriber_id') . "'",__FILE__,__LINE__);
     
      XT::query("delete from " . XT::getTable('newsletter_unsubscribed') . " where
     `category_id`='" . $category . "' 
     AND 
     `subscription_id`='" . XT::getValue('subscriber_id') . "'",__FILE__,__LINE__);
  
     XT::query("INSERT INTO " . XT::getTable('newsletter_unsubscribed') . "(category_id,date,subscription_id) VALUES ('" . $category . "','" . time() . "','" . XT::getValue('subscriber_id') . "') ",__FILE__,__LINE__);
     
     
}else{
    XT::query("delete from " . XT::getTable('newsletter_subscr2cat') . " where
     `subscription_id`='" . XT::getValue('subscriber_id') . "'",__FILE__,__LINE__);
    // delete subscriber from system
    XT::query("DELETE FROM " . XT::getTable('newsletter_subscriptions') . " WHERE id = " . XT::getValue("subscriber_id"),__FILE__,__LINE__);
   
}

?>