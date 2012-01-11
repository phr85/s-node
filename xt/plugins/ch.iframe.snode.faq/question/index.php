<?php

// Eneable or disable captcha
$captcha = XT::getParam('captcha') == 1 ? true : false;
$confirmation_tpl = XT::getParam('confirmation_tpl');
XT::setValue('confirmation_tpl',$confirmation_tpl);

// Read input
$name = strip_tags(XT::getValue('name'));
$message = strip_tags(XT::getValue('message'));
$title = strip_tags(XT::getValue('title'));
$email = trim(strip_tags(XT::getValue('email')));


// If pseudoaction 'ask' is there // Form submitted
if(XT::getValue("pseudoaction")=='ask'){
	// check if name is not empty
	if ($name !=""){
		$forgotname = false;
		XT::setValue('name',$name);
		$data['content']['name'] = $name;
	}else{
		$forgotname = true;
		$data['error']['name'] = XT::translate('No name entered');
	}

	// Is there any information in the title input?
	if ($title !=""){
		$forgottitle = false;
		XT::setValue('title',$title);
		$data['content']['title'] = $title;
	}else{
		$forgottitle = true;
		$data['error']['title'] = XT::translate('No title');
	}

	// Is there any information in the message textarea?
	if ($message !=""){
		$forgotmessage = false;
		XT::setValue('message',$message);
		$data['content']['message'] = $message;
	}else{
		$forgotmessage = true;
		$data['error']['message'] = XT::translate('No message');
	}

	// Check if Email is empty
	if ($email !=""){
		$forgotemail = false;
		$data['content']['email'] = $email;
		// If is not empty, check if correct
		if (!XT::checkEmail($email)) {
			$data['error']['email'] = XT::translate('Email not valid');
		}else{
			XT::setValue('email',$email);
		}
	}else{
		$forgotemail = true;
		$data['error']['email'] = XT::translate('No Email');
	}

	// If there any in the submitted data
	if ($forgotname == true OR $forgotmessage == true OR $forgotemail == true){
		$data['error']['main'] = XT::translate('Please check your input');
	}else{
		if ($captcha == false) {
			// assign errors form the action
			XT::call('ask');
		} else {
			// If Captcha is enabled
			if ($_SESSION['captcha_faq_image'] == md5(strtoupper($_REQUEST['captcha_faq']))) {
				XT::call('ask');
				$data['status'] = XT::translate('Question sent');

				// Captcha not correct -> assign errors
			} else {
				$data['error']['captcha'] = XT::translate('Captcha incorrect');
			}
		}
	}
}

// Parameter: Captcha enabled?
$data['captcha'] = $captcha;


XT::assign("xt" . XT::getBaseID() . "_question", $data);

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';
$content = XT::build($style);

?>