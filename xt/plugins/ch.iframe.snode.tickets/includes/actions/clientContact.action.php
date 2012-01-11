<?php
require_once(CLASS_DIR . "/phpmailer/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->IsHTML(false);
$mail->Encoding = '7bit';
$mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
$mail->FromName = XT::getUserProperties("firstName") . " " . XT::getUserProperties("lastName");
$mail->From = XT::getUserProperties("email");
$mail->Host = $GLOBALS['cfg']->get('smtp','Host');

$mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
    $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
    $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
}

$mail->Subject  =  XT::translate("New request");
$mail->AddAddress(XT::getUserProperties("email",XT::getValue("contact_id")));
$mail->Body = XT::getValue("comment");
if(!$mail->Send()){
	XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
}
?>