<?php

if ($_SESSION['user']['id'] != ""){
	$user = array();
	$userLogin == 1;
	$userName == $_SESSION['user']['name'];	
	XT::setSessionValue($userLogin, 'userlogin');
	XT::setSessionValue($userName, 'username');
}else{
	$data['loggedin'] = 0;
}

// Eneable or disable captcha
$captcha = XT::getParam('captcha') == 1 ? true : false;

// Parameter :: style
$style = XT::getParam("style") != '' ? XT::getParam("style") : 'default.tpl';
$style = str_replace(".tpl","",$style);

// Read input
$name = strip_tags(XT::getValue('name'));

$date = XT::autoVal('datearray',"S");

$description = strip_tags(XT::getValue('description'));
$title = strip_tags(XT::getValue('title'));
$email = strip_tags(XT::getValue('email'));


// Parameter: Captcha enabled?
$data['captcha'] = $captcha;

$data['error'] = XT::getValue('errors');
$data['content'] = XT::getValue('inputvalues');

XT::assign("xt" . XT::getBaseID() . "_add", $data);

$content = XT::build($style."/start.tpl");

?>