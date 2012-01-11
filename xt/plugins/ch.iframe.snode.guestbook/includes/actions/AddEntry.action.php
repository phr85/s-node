<?php
// target template
$target_tpl = XT::getParam('target_tpl') != '' ? XT::getParam('target_tpl') : '';

// Check email
if (!XT::checkEmail(trim(XT::getValue('email')))) {
            $gberror[] = "E-Mail not valid";
}

if (strlen(trim(XT::getValue('comment'))) <= 1) {
	$gberror[] = "Please enter a comment";
}

if (strlen(trim(XT::getValue('name'))) <= 1) {
	$gberror[] = "Please enter a name";
}

$active = 0;
if (XT::getConfig("insertActive") == 1) {
	$active = 1;
}

if (count($gberror) < 1) {
	$now  = time();
	$result = XT::query("
	INSERT INTO " . XT::getTable("guestbook") . " (
	active,
	creation_date,
	creation_user,
	ip,
	name,
	email,
	website,
	comment
	) VALUES (
	" . $active . ",
	'". $now ."',
	0,
	'" . $_SERVER['REMOTE_ADDR'] . "',
	'" . trim(strip_tags(XT::getValue('name'))) . "',
	'" . trim(XT::getValue('email')) . "',
	'" . trim(strip_tags(XT::getValue('website'))) . "',
	'" . trim(strip_tags(XT::getValue('comment'),"<b>,<i>,<p>")) . "'
	)",__FILE__,__LINE__);
	XT::getQueryData($result);
	
	// Send an email to the moderator
	if (XT::getConfig("moderate") != "") {
		
		$count = XT::getQueryData(XT::query("SELECT id FROM " . XT::getTable("guestbook") . " WHERE creation_date=" . $now,__FILE__,__LINE__));
    	$newid = $count[0]['id'];
    		
		$data['name'] = trim(strip_tags(XT::getValue('name')));
		$data['email'] = trim(XT::getValue('email'));
		$data['website'] = XT::getValue('website');
		$data['comment'] = trim(strip_tags(XT::getValue('comment'),"<b>,<i>,<p>"));
		$data['ip'] = $_SERVER['REMOTE_ADDR'];
		$data['date'] = time();
		$data['id'] = $newid;
		XT::assign("xt" . XT::getBaseID() . "_add", $data);
		
		require_once(CLASS_DIR . "/phpmailer/class.phpmailer.php");
		$mail = new PHPMailer();
	    $mail->IsSMTP();
	    $mail->IsHTML(true);
	    $mail->Encoding = '7bit';
	    $mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
	    $mail->FromName = XT::getValue('name');
	    $mail->From = XT::getValue('email');
	    $mail->Host = $GLOBALS['cfg']->get('smtp','Host');
	
	    $mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
	    if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
	        $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
	        $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
	    }
	
	    $mail->AddAddress(XT::getConfig("moderate"),'');
	    $mail->Subject  =  $_SERVER['SERVER_NAME'] . " " . XT::translate('new entry');
		XT::assign("MAIL_DATA",$data);
		if(is_file(TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.guestbook/mail/moderate_comment.tpl')){
	        $mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.guestbook/mail/moderate_comment.tpl');
	    }else {
	        $mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . 'default//ch.iframe.snode.guestbook/mail/moderate_comment.tpl');
	    }
	    
	    if(!$mail->Send()){
        	XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
	    }
	}
	
	// Clear data
	XT::setValue('name','');
	XT::setValue('email','');
	XT::setValue('website','');
	XT::setValue('comment','');
	
	if ($target_tpl != "") {
		header('Location: index.php?TPL=' . $target_tpl);
	}
} else {
	XT::setValue('gberror',$gberror);
}

?>