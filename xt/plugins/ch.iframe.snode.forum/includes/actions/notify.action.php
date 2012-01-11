<?php
$settings = XT::getConfig('settings');

$result = XT::query("SELECT DISTINCT user.email, user.id from " . XT::getTable('forum_notification') . " as note
INNER JOIN  " . XT::getTable('user') . " as user on (note.user_id = user.id)
WHERE
    note.topic_id ='" . XT::getValue('topic_id') . "'
AND
    note.notified=0
AND
    note.type=0
    ",__FILE__,__LINE__);
$mail_addresses = XT::getQueryData($result);
if(count($mail_addresses)>0){

    $result = XT::query("SELECT * from " . XT::getTable('forum_topics') . " where id = " . XT::getValue('topic_id'),__FILE__,__LINE__);
    $subject = XT::getQueryData($result);
    $result = XT::query("SELECT * FROM " . XT::getTable("forum_postings") . " WHERE topic_id = " . XT::getValue('topic_id') . " order by id desc limit 0,1",__FILE__,__LINE__);
    $data['topic_id'] = XT::getValue('topic_id');
    $data['date'] = TIME;
    $data['title'] = XT::getValue('title');
    $data['url'] =  "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?TPL=" . $settings['topic']['TPL'] . "&x" . $GLOBALS['plugin']->getBaseID() . "_topic_id=" . XT::getValue('topic_id') . "#bottom";
    $data['data'] = XT::getQueryData($result);
    // user
    $result = XT::query("SELECT user.* from " . XT::getTable('user') . " as user where user.id = '" . XT::getUserID() . "'",__FILE__,__LINE__);
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
    $mail->Subject  =  $subject[0]['title'];
    $mail->Body     =  XT::build("mail.tpl");
    foreach ($mail_addresses as $mailaddr) {
        //if(XT::getUserID() != $mailaddr['id']){
            $mail->addBCC($mailaddr['email']);
        //}
    }
    if(!$mail->Send()){
        XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
    }
}
// als gesendet setzen
XT::query("update " . XT::getTable('forum_notification') . " set `notified`='1' where `topic_id`='" . XT::getValue('topic_id') . "' AND type=0",__FILE__,__LINE__);

$_SESSION['notify']['topic'][XT::getValue('topic_id')] = false;

?>