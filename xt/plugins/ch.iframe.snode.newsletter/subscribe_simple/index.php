<?php

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';


// Parameter :: Category ID
$category_id = XT::autoVal('category',"P") > 0 ? XT::autoVal('category',"P") : 0;


$result = XT::query("SELECT * from " . XT::getTable('newsletter_categories') . " WHERE id=" . $category_id,__FILE__,__LINE__);
$tmp_data = XT::getQueryData($result);
XT::assign("CATEGORY",$tmp_data[0]);

// Check for a subscription
if(XT::getValue('email') != '' && XT::getValue('unsubscribe')=="" ){
    XT::assign("SUBSCRIPTION_TRY", true);

    if(XT::checkEMail(XT::getValue('email'))){


       $result = XT::query("SELECT subs.email FROM " . XT::getTable("newsletter_subscriptions") . " as subs
       inner join " . XT::getTable("newsletter_subscr2cat") . " as subcat on (subcat.subscription_id = subs.id AND subcat.category_id=" . $category_id . ")
       WHERE subs.email = '" . XT::getValue('email') . "'",__FILE__,__LINE__);

        if($result->RecordCount() > 0){
            // E-Mail already subscribed
            XT::assign("SUBSCRIPTION_OK", false);
            XT::assign("ERROR", $GLOBALS['lang']->msg("This e-mail address has already subscribed"));

        } else {


            // Check for email
            $result = XT::query("
            SELECT id FROM " . XT::getTable("newsletter_subscriptions") . "
            WHERE email = '" . XT::getValue('email') . "'
        ",__FILE__,__LINE__);
            $subscription_id = XT::getQueryData($result);

            // adresse erfassen

            if(empty($subscription_id[0]['id'])){
                // Do subscription
                XT::query("
                INSERT INTO
                    " . XT::getTable("newsletter_subscriptions") . " (
                        user_id,
                        email,
                        name,
                        creation_date,
                        creation_user,
						lang
                ) VALUES (
                        '" . XT::getUserID() . "',
                        '" . XT::getValue('email') . "',
                        '" . XT::getValue('name') . "',
                        " . TIME . ",
                        " . XT::getUserID() . ",
						'" . XT::getValue('lang') . "'
                )",__FILE__,__LINE__);

                $result = XT::query("SELECT id FROM " . XT::getTable("newsletter_subscriptions") . " WHERE email = '" . XT::getValue('email') . "'",__FILE__,__LINE__);
                $subscription_id = XT::getQueryData($result);
            }
            // Subscribe to category
            XT::query("INSERT INTO " . XT::getTable("newsletter_subscr2cat") . " ( `category_id`, `subscription_id`, `type` ) values (  '" . $category_id . "',  '" . $subscription_id[0]['id'] . "',  '0' )",__FILE__,__LINE__);

            XT::assign("SUBSCRIPTION_OK", true);
            XT::assign("SUBSCRIPTION_EMAIL", XT::getValue('email'));
            XT::assign("SUBSCRIPTION_NAME", XT::getValue('name'));

        }

    } else {
        XT::assign("SUBSCRIPTION_OK", false);
        XT::assign("ERROR", $GLOBALS['lang']->msg("Invalid email address"));
    }
}



//Unsubscribe
if(XT::getValue('unsubscribe')!=""){

    // Check for email
            $result = XT::query("
            SELECT id FROM " . XT::getTable("newsletter_subscriptions") . "
            WHERE email = '" . XT::getValue('email') . "'
        ",__FILE__,__LINE__);
            $subscription_id = XT::getQueryData($result);


    $result = XT::query("
            DELETE FROM " . XT::getTable("newsletter_subscr2cat") . "
            WHERE
                category_id = '" . $category_id . "'
            AND
               subscription_id = '" . $subscription_id[0]['id']  . "'
            ",__FILE__,__LINE__);
            
     XT::query("delete from " . XT::getTable('newsletter_unsubscribed') . " where
     `category_id`='" . $category_id . "' 
     AND 
     `subscription_id`='" . $subscription_id[0]['id']  . "'",__FILE__,__LINE__);
  
     XT::query("INSERT INTO " . XT::getTable('newsletter_unsubscribed') . "(category_id,date,subscription_id) VALUES ('" . $category_id . "','" . time() . "','" . $subscription_id[0]['id'] . "') ",__FILE__,__LINE__);
       
    XT::assign("SUBSCRIPTION_OK", false);
    XT::assign("ERROR", $GLOBALS['lang']->msg("unsubcribtion done"));
    XT::assign("SUBSCRIPTION_TRY", true);
}
XT::assign("SUBSCRIPTION_EMAIL", XT::getValue('email'));
XT::assign("SUBSCRIPTION_NAME", XT::getValue('name'));
$content = XT::build($style);

?>