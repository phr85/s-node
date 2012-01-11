<?php

XT::call('saveFaq');

// Get form details
$data_form = array();
$result_form = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable("faq") . "
    WHERE
        id = '" . XT::getValue("id") . "' AND
        lang = '" . XT::getActiveLang() . "'
",__FILE__,__LINE__);
while($row_form = $result_form->FetchRow()){
    $data_form[] = $row_form;
}

// Get Data
$mailcontent = array();
$mailcontent['title'] = $data_form[0]['title'];
$mailcontent['questioner'] = $data_form[0]['questioner'];
$mailcontent['question_title'] = $data_form[0]['title'];
$mailcontent['description'] = $data_form[0]['description'];
$mailcontent['answer_address'] = XT::getValue('answer_address');
$mailcontent['receiver'] = $data_form[0]['questioner_mail'];
$mailcontent['answer'] = $data_form[0]['answer'];
$mailcontent['answer_title'] = $data_form[0]['answer_title'];
$mailcontent['answer_name'] = $data_form[0]['answer_name'];

// Check if fields are empty. If they are empty, abort action.
if ($mailcontent['question_title'] == ""){
    XT::actionStop(XT::translate("Question title cannot be empty"));
}elseif ($mailcontent['description'] == ""){
    XT::actionStop(XT::translate("Description cannot be empty"));
}elseif ($mailcontent['receiver'] == ""){
    XT::actionStop(XT::translate("Receiver cannot be empty"));
}elseif ($mailcontent['receiver'] == ""){
    XT::actionStop(XT::translate("Receiver cannot be empty"));
}elseif ($mailcontent['answer_name'] == ""){
    XT::actionStop(XT::translate("Answer name cannot be empty"));
}elseif ($mailcontent['receiver'] == ""){
    XT::actionStop(XT::translate("Receiver cannot be empty"));
}elseif ($mailcontent['answer_title'] == ""){
    XT::actionStop(XT::translate("Answer title cannot be empty"));
}elseif ($mailcontent['answer'] == ""){
    XT::actionStop(XT::translate("Answer cannot be empty"));
}else{

    XT::assign("xt".XT::getBaseID()."_MAILCONTENT",$mailcontent);
    
    // Send Mail to Questioner
    require_once(CLASS_DIR . "/phpmailer/class.phpmailer.php");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->IsHTML(true);
    $mail->Encoding = '7bit';
    $mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
    $mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
    if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
        $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
        $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
    }
    $mail->Host = $GLOBALS['cfg']->get('smtp','Host');
    $mail->From = $mailcontent['answer_address'];
    $mail->FromName = $mailcontent['answer_name'];
    $mail->AddAddress($mailcontent['receiver']);
    $mail->AddCC($mailcontent['answer_address']);
    $mail->Subject = $mailcontent['answer_title'];
    $mail->Body  = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'mail/default_'.XT::getActiveLang().'.tpl');
    $mail->WordWrap = 50;
    
    if($mail->Send()) {
       XT::log(XT::translate("Message was sent"),__FILE__,__LINE__,XT_INFO);  
    }
    else{
       XT::log(XT::translate("Message was not sent. Error: ").$mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);  
    }
    
    // Set Message Sent to 1 so user knows that this question has already been answer.
    XT::query("
        UPDATE 
            " . XT::getTable("faq") . " 
        SET 
            is_answered = 1
        WHERE
            id = " . XT::getValue("id") . " AND
            lang = '" . XT::getActiveLang() . "'
    ",__FILE__,__LINE__);
    
}

XT::setAdminModule("edit");

?>