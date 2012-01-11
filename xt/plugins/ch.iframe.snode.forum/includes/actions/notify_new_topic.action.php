<?php
$settings = XT::getConfig('settings');

$result = XT::query("SELECT DISTINCT user.email, note.user_id from " . XT::getTable('forum_notification') . " as note
INNER JOIN  " . XT::getTable('user') . " as user on (note.user_id = user.id)
WHERE
    note.topic_id ='" . XT::getSessionValue('forum_id') . "'
AND
    note.type=1
    ",__FILE__,__LINE__);
$mail_addresses = XT::getQueryData($result);

$data['topic_id'] = XT::getSessionValue('topic_id') ;
$data['date'] = TIME;
$data['title'] = XT::getValue('title');
$data['url'] =  "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?TPL=" . $settings['forum']['TPL'] . "&x" . $GLOBALS['plugin']->getBaseID() . "_forum_id=" . XT::getSessionValue('forum_id')  . "#bottom";

// user

$result = XT::query("SELECT user.username, user.id from " . XT::getTable('user') . " as user where user.id = '" . XT::getUserID() . "'",__FILE__,__LINE__);
$user = XT::getQueryData($result);
$data['user'] = $user[0];
XT::assign("DATA",$data);

// generate email
require_once(CLASS_DIR . "/phpmailer/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->IsHTML(true);
$mail->Encoding = '7bit';
$mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
$mail->FromName = $GLOBALS['cfg']->get("system","name");
$mail->From = $GLOBALS['cfg']->get("system","email");
$mail->Host = $GLOBALS['cfg']->get('smtp','Host');

$mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
    $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
    $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
}
$mail->Subject  =  XT::getValue('title');
$mail->Body     =  XT::build("mail.tpl");
foreach ($mail_addresses as $mailaddr) {
    $mail->addBCC($mailaddr['email']);
}
if(!$mail->Send()){
    XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
}

?>