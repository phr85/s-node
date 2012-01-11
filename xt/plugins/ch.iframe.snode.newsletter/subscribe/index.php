<?php

$selected_categories = XT::getValue('category');
if(!is_array($selected_categories)){
    $selected_categories = array();
}
// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Get all categories
$result = XT::query("
    SELECT
        id,
        title
    FROM
        " . XT::getDatabasePrefix() . "newsletter_categories
    ORDER BY id ASC
",__FILE__,__LINE__);

$categories = array();
while($row = $result->FetchRow()){
    if($row['id'] == $selected_categories[$row['id']]){
        $row['selected'] = true;
    }
    $categories[] = $row;
}

$assign['CATEGORIES'] = $categories;
$assign['LANGS'] = $GLOBALS['cfg']->getLangs();
$error = array();
$nedded_fields = XT::getValue('needed_fields');
if (is_array($nedded_fields )){
	foreach ($nedded_fields  as $needed_field => $error_text) {
		if (XT::getValue($needed_field) == "") {
			$error[] = $error_text;
		}
	}
}
$assign['title'] = XT::getValue('title');
$assign['anrede'] = XT::getValue('anrede');
$assign['email'] = XT::getValue('email');
$assign['lang'] = XT::getValue('lang');
$assign['firstname'] = XT::getValue('firstname');
$assign['lastname'] = XT::getValue('lastname');
$assign['company'] = XT::getValue('company');
$assign['mobile'] = XT::getValue('mobile');

foreach ($selected_categories as $category_id) {
    if(XT::getValue('email') != '' && (XT::getValue('unsubscribe') == "no" || XT::getValue('subscribe') != "")) {
        $assign['SUBSCRIPTION_TRY'] = true;
		if (count($error) == 0) {
	        if(XT::checkEMail(XT::getValue('email'))){
	
	
	            $result = XT::query("SELECT subs.email FROM " . XT::getTable("newsletter_subscriptions") . " as subs
	       inner join " . XT::getTable("newsletter_subscr2cat") . " as subcat on (subcat.subscription_id = subs.id AND subcat.category_id=" . $category_id . ")
	       WHERE subs.email = '" . XT::getValue('email') . "'",__FILE__,__LINE__);
	
	            if($result->RecordCount() > 0){
	                // E-Mail already subscribed
	                
	                $assign['SUBSCRIPTION_OK'] = false;
	                $error[] = $GLOBALS['lang']->msg("This e-mail address has already subscribed");
	
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
                            title,
							anrede,
							firstname,
							lastname,
							company,
							lang,
							mobile,
	                        creation_date,
	                        creation_user
	                ) VALUES (
	                        '" . XT::getUserID() . "',
	                        '" . XT::getValue('email') . "',
	                        '" . XT::getValue('name') . "',
                            '" . XT::getValue('title') . "',
							'" . XT::getValue('anrede') . "',
							'" . XT::getValue('firstname') . "',
							'" . XT::getValue('lastname') . "',
							'" . XT::getValue('company') . "',
							'" . XT::getValue('lang') . "',
							'" . XT::getValue('mobile') . "',
	                        " . time() . ",
	                        " . XT::getUserID() . "
	                )",__FILE__,__LINE__);
	
	                    $result = XT::query("SELECT id FROM " . XT::getTable("newsletter_subscriptions") . " WHERE email = '" . XT::getValue('email') . "'",__FILE__,__LINE__);
	                    $subscription_id = XT::getQueryData($result);
	                }
	                // Subscribe to category
	                XT::query("INSERT INTO " . XT::getTable("newsletter_subscr2cat") . " ( `category_id`, `subscription_id`, `type` ) values (  '" . $category_id . "',  '" . $subscription_id[0]['id'] . "',  '0' )",__FILE__,__LINE__);
					
					$assign['SUBSCRIPTION_OK'] = true;
	            }
	
	        } else {
	            $error[] = $GLOBALS['lang']->msg("Invalid email address");
			}
    	}
    }
    if (XT::getValue('email') == ''){
    	$error[99] = $GLOBALS['lang']->msg("Invalid email address");
    }
    if (count($error) > 0) {
    	$assign['SUBSCRIPTION_OK'] = false;
    }
	$assign['TARGET_TPL'] = $target_tpl;

    //Unsubscribe
    if(XT::getValue('unsubscribe') != "no" && XT::getValue('unsubscribe') != ""){
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
       
        $assign['SUBSCRIPTION_OK'] = false;
        $assign['UNSUBSCRIPTION_OK'] = true;
        $assign['SUBSCRIPTION_TRY'] = true;
    }
}

// Make an email to inform the user about his subscription
if ($assign['SUBSCRIPTION_OK'] == true) {
	require_once(CLASS_DIR . "/phpmailer/class.phpmailer.php");
	$mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->IsHTML(true);
    $mail->Encoding = '7bit';
    $mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
    $mail->FromName = $GLOBALS['cfg']->get('system','name');
    $mail->From = $GLOBALS['cfg']->get('system','email');
    $mail->Host = $GLOBALS['cfg']->get('smtp','Host');

    $mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
    if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
        $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
        $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
    }

    $mail->AddAddress($assign['email'],$assign['firstname'] . '' . $assign['lastname']);
    if (XT::getConfig("inform_subscriptions") != false) {
    	$mail->AddBCC(XT::getConfig("inform_subscriptions"));
	}
    $mail->Subject  =  XT::translate("Thank you for your subscription");
	XT::assign("MAIL_DATA",$assign);
	if(is_file(TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.newsletter/mail/confirmation.tpl')){
        $mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.newsletter/mail/confirmation.tpl');
    }else {
        $mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . 'default/ch.iframe.snode.newsletter/mail/confirmation.tpl');
    }
    
    if(!$mail->Send()){
    	XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
    }
}

$assign['ERROR'] = $error;
$data[XT::getBaseID()]['subscribe'] = $assign;
XT::assign("data" ,$data);
$content = XT::build($style);
?>