<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

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

XT::enableAdminNavigator('','',"
    SELECT 
        count(id) as count_id
    FROM 
        " . XT::getTable('mail_head_body') . " 
    WHERE 
        folder = '" . $folder . "' AND 
        account_id = " . $account_id . "
");

// $label, $action, $set="default", $icon, $form="", $target="", $accesskey ="", $focus="", $script=""
XT::addImageButton('Send and receive', 'sendAndReceive', 'default', 'refresh.png',1,'master');
XT::addImageButton('New Mail', 'newMail', 'default', 'mail_new.png',1,'master');

$result = XT::query("
    SELECT 
        id, 
        message_id, 
        subject, 
        date, 
        state_recent, 
        state_unseen, 
        state_answered, 
        state_deleted, 
        senderaddress, 
        zuaddress,
        size 
    FROM 
        " . XT::getTable('mail_head_body') . " 
    WHERE 
        folder = '" . $folder . "' AND 
        account_id = " . $account_id . "
    ORDER BY 
        date DESC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
", __FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

foreach ($data as $key => $value ){
    if ($value['subject'] == ''){
        $data[$key]['subject'] = 'No Subject';
    }
}

XT::assign("MESSAGES", $data);
XT::assign("FOLDER", $folder);

$content = XT::build('overview.tpl');

?>