<?php
XT::call('LiveSaveRecipe');
XT::query("UPDATE " . XT::getTable('rezepte') . "
          SET
              active_by_user= 1
          WHERE
              id=" . XT::getValue('id') . "
          ",__FILE__,__LINE__);
if(LANGFILE !='LANGFILE'){
    $indexfile = LANGFILE;
}else{
    $indexfile = "index.php";
}


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

$mail->Subject  =  XT::translate("new recipe");
$mail->Body     =  $GLOBALS['cfg']->get("system","name");
$mail->AddAddress(XT::getConfig('notified_email'));
if(!$mail->Send()){
    XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
}

header("Location: http://" . $_SERVER['HTTP_HOST'] . "/" . $indexfile . "?TPL=" . XT::getParam("overview_tpl"));

?>