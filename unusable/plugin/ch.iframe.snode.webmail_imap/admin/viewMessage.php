<?php
// This variablse should be commitet in future
$account_id = XT::getSessionValue("account_id") == "" ? XT::getValue("account_id") : XT::getSessionValue("account_id");

if (XT::getValue("folder") != "") {
    XT::setSessionValue("folder", XT::getValue("folder"));
}
elseif (XT::getSessionValue("folder") != "") {
    XT::setValue("folder", XT::getSessionValue("folder"));
}
else {
    XT::setSessionValue("folder", "INBOX");
}

$folder = XT::getSessionValue("folder");

// Get the informations of the commitet mail
$result = XT::query("
    SELECT 
        message_id, 
        subject, 
        date, 
        senderaddress,
        zuaddress,
        von,
        zu, 
        body,
        mid,
        ftype,
        size 
    FROM 
        " . XT::getTable('mail_head_body') ." 
    WHERE 
        id = " . XT::getValue('message_id'), 
__FILE__,__LINE__);
$mail = $result->FetchRow();

// If the Mail-Body is empty get the Body and save them to the Database
if ($mail['body'] == ''){
   ini_set("include_path", (CLASS_DIR . "PEAR" . PATH_SEPARATOR . ini_get("include_path")));
   require_once(CLASS_DIR . 'PEAR/Mail/IMAPv2.php');
   
    // Get the account informations
    $result = XT::query("
        SELECT 
            in_type, 
            in_user, 
            in_pass, 
            in_server, 
            in_port 
        FROM 
            " . XT::getTable('mail_accounts') ." 
        WHERE 
            id = " . $account_id, 
    __FILE__,__LINE__);
    $account = $result->FetchRow();

    // initiate connection
    $connection = $account['in_type'] . '://' . $account['in_user'] . ':' . $account['in_pass'] . '@' . $account['in_server'] . ':' . $account['in_port'] . '/' . $folder;
    $msg =& new Mail_IMAPv2($connection); 
    
    // Get the body
    $body = $msg->getBody($mail['mid']);
    $mail['body'] = $body['message'];
    $mail['ftype'] = $body['ftype'];

    // Save the body and bodytype in database
    XT::query("
            UPDATE
              " .  XT::getTable('mail_head_body') . "
            SET 
                ftype = '" . $mail['ftype'] . "',
                body = '" . addslashes($mail['body']) . "'
            WHERE message_id = '" . $mail['message_id'] ."'"
            ,__FILE__,__LINE__);
}


// if the bodytype is text/plain
if($mail['ftype'] == "text/plain"){
    $mail['body'] = nl2br($mail['body']);
}

XT::addImageButton('Answer', 'answer', 'default', 'mail_out.png',1,'master');
XT::addImageButton('Forward', 'forward', 'default', 'mail_forward.png',1,'master');
XT::addImageButton('Delete', 'delete', 'default', 'mail_delete.png',1,'master');
XT::assign("MAIL", $mail);
XT::assign("FOLDER", $folder);
$content = XT::build('viewMessage.tpl');

?>