<?php

ini_set("include_path", (CLASS_DIR . "PEAR" . PATH_SEPARATOR . ini_get("include_path")));
require_once(CLASS_DIR . 'PEAR/Mail/IMAPv2.php');

$account_id = XT::getSessionValue("account_id");
$folder = XT::getSessionValue("folder");


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
$imap =& new Mail_IMAPv2($connection);

// Count the Messages
//$msgcount = 2;
$msgcount = $imap->messageCount();

// download all messages
for ($mid = 1; $mid <= $msgcount; $mid++) {
    // Get the headers
    $headers = $imap->getHeaders($mid);
}


// download all message_id's from database and save them to array $saved
$result = XT::query("
    SELECT 
        message_id,
        mid
    FROM 
        " . XT::getTable('mail_head_body') . " 
    WHERE 
        folder = '" . $folder . "' AND 
        account_id = " . $account_id
, __FILE__,__LINE__);

$saved = array();
$mid = array();
while($row = $result->FetchRow()){
    $saved[] = $row['message_id'];
}


// Find new messages and save them to the database
$countNewMail = 0;
if (is_array($imap->header)) {
    reset ($imap->header);
    $mid = 1;
    while (list($key, $value) = each ($imap->header)){
        
        if (!in_array($value['message_id'], $saved)){
            
            $toadress = str_replace("'", "", $value['toaddress']);
            XT::query("
                INSERT INTO
                  " .  XT::getTable('mail_head_body') . "
                (
                    message_id,
                    folder,
                    subject,
                    account_id,
                    date,
                    vonaddress,
                    in_reply_to,
                    followup_to,
                    von,
                    von_personal,
                    senderaddress,
                    sender,
                    sender_personal,
                    reply_toaddress,
                    reply_to,
                    reply_to_personal,
                    return_path,
                    zuaddress,
                    zu,
                    zu_personal,
                    ccaddress,
                    cc,
                    cc_personal,
                    bccaddress,
                    bcc,
                    bcc_personal,
                    size,
                    state_body
                ) VALUES (
                    '" . $value['message_id'] . "',
                    '" . $folder . "',
                    '" . str_replace("'", "", $value['subject']) . "',
                    '" . $account_id . "',
                    '" . str_replace("'", "", $value['udate']) . "',
                    '" . str_replace("'", "", $value['fromadress']) . "',
                    '" . str_replace("'", "", $value['in_reply_to']) . "',
                    '" . str_replace("'", "", $value['followup_to']) . "',
                    '" . str_replace("'", "", $value['from'][0]) . "',
                    '" . str_replace("'", "", $value['from_personal'][0]) . "',
                    '" . str_replace("'", "", $value['senderaddress']) . "',
                    '" . str_replace("'", "", $value['sender'][0]) . "',
                    '" . str_replace("'", "", $value['sender_personal'][0]) . "',
                    '" . str_replace("'", "", $value['reply_toadress']). "',
                    '" . str_replace("'", "", $value['reply_to'][0]) . "',
                    '" . str_replace("'", "", $value['reply_to_personal'][0]) . "',
                    '" . str_replace("'", "", $value['return_path']) . "',
                    '" . str_replace("'", "", $value['toaddress']) . "',
                    '" . str_replace("'", "", $value['to'][0]) . "',
                    '" . str_replace("'", "", $value['to_personal'][0]) . "',
                    '" . str_replace("'", "", $value['ccadress']) . "',
                    '" . str_replace("'", "", $value['cc'][0]) . "',
                    '" . str_replace("'", "", $value['cc_personal'][0]) . "',
                    '" . str_replace("'", "", $value['bccaddress']) . "',
                    '" . str_replace("'", "", $value['bcc'][0]) . "',
                    '" . str_replace("'", "", $value['bcc_personal'][0]) . "',
                    '" . str_replace("'", "", $value['Size']) . "',
                    '0'
                )
                ",__FILE__,__LINE__);
            $countNewMail++; 
        }
        // recent mail?
        if ($value['Recent'] == 'R' or $value['Recent'] == 'N'){
            $state_recent = 1;
        } else {
            $state_recent = 0;
        }
        
        // unseen mail?
        if ($value['Unseen'] == 'U' || $value['Recent'] == 'N'){
            $state_unseen = 1;
        } else {
            $state_unseen = 0;
        }
        
        // answered mail?
        if ($value['Answered'] == 'A'){
            $state_answered = 1;
        } else {
            $state_answered = 0;
        }
        
        // deleted mail?
        if ($value['Deleted'] == 'D'){
            $state_deleted = 1;
        } else {
            $state_deleted = 0;
        }
        XT::query("
            UPDATE
              " .  XT::getTable('mail_head_body') . "
            SET 
                state_recent = " . $state_recent . ",
                state_unseen = " . $state_unseen . ",
                state_answered = " . $state_answered . ",
                mid = " . $mid . ",
                state_deleted = " . $state_deleted . "
            WHERE message_id = '" . $value['message_id'] ."'"
            ,__FILE__,__LINE__);
        $mid++;
    }
}


// Search deleted Mails
$countDelMail = 0;
reset($saved);
reset($imap->header);

$new_message_ids = array();
while(list($key, $value) = each($imap->header)) {
    $new_message_ids[] = $value['message_id'];
}
while (list($key, $value) = each ($saved)){
    
     if (!in_array($value, $new_message_ids)){
         
        XT::query("
            DELETE
            FROM 
                " . XT::getTable('mail_head_body') ." 
            WHERE 
                message_id = '" . $value . "'", 
        __FILE__,__LINE__);
        $countDelMail++;
     }
}


$initial = 0;
// Get the Folders on IMAP-Server
$mbox = imap_open ("{" . $account['in_server'] . ":" . $account[in_port] . "}", $account['in_user'], $account['in_pass']);
$list = imap_getmailboxes($mbox, "{" . $account['in_server'] . ":" . $account[in_port] . "}", "*");
imap_close($mbox);

// Get all folders from database and save them to array $saved_folder
$result = XT::query("
    SELECT 
        path
    FROM 
        " . XT::getTable('mail_folders') . " 
    WHERE 
        level > 1 AND 
        account_id = " . $account_id
, __FILE__,__LINE__);

$saved_folder = array();
while($row = $result->FetchRow()){
    $saved_folder[] = $row['path'];
}


// If there are new Folders, add them to the database
require_once(CLASS_DIR . 'tree.class.php');

$tree = new XT_Tree('mail_folders');

$nodes = array();

if (is_array($list)) {
    reset ($list);
    $path_befor = "root";
    $level_befor = 2;
    while (list($key, $val) = each ($list)) {
        unset($newid);
        // Build title
        $results = split('}',$val->name);
        $path = $results[1];
        $result = XT::query("
            SELECT 
                id, 
                level 
            FROM 
                " . XT::getTable('mail_folders') ." 
            WHERE 
                account_id = '" . $account_id . "' AND 
                path = '" . $path_befor . "'
            ",__FILE__,__LINE__);
        $folder_befor = $result->FetchRow();
        
        $level = substr_count($path, $val->delimiter) + 2;
        if($level > $level_befor){
             $saved_id[$folder_befor['level']] = $folder_befor['id'];
        }
        
        if ($initial == 1){
            if(strpos($path, $val->delimiter) > 0){
                $level = substr_count($path, $val->delimiter) + 2;
                $title = substr(strrchr($path, $val->delimiter),1);
                $newid = $tree->addChildNode($nodes[$level-1]);
            } else {
                $level = 2;
                $newid = $tree->addChildNode(1);
                $title = $path;
            }
            
            $nodes[$level] = $newid;
            
            if($newid > 0){
                // Update new created entry
                XT::query("
                    UPDATE
                        ". XT::getTable('mail_folders') . "
                    SET
                        attributes = '" . $val->attributes . "',
                        delimiter = '" . $val->delimiter . "',
                        title = '" . $title . "',
                        tree_id = '" . $account_id . "',
                        account_id = '" . $account_id . "',
                        path = '" . $path . "'
                    WHERE
                        id = '" . $newid . "'
                ",__FILE__,__LINE__);
            }
        } else {
            // check, if the folder is saved
            if (!in_array($path, $saved_folder)){
                $level = substr_count($path, $val->delimiter) + 2;
                $title = substr(strrchr($path, $val->delimiter),1);

                if($level > $folder_befor['level']){
                    // einfügen als unterordner
                    $newid = $tree->addNode($folder_befor['id'], "first");
                } elseif($level < $folder_befor['level']){
                    // einfügen als übergeordneter ordner; 
                    $newid = $tree->addNode($saved_id[$level]);
                } elseif($level == $folder_befor['level']){
                    // einfügen als ordner auf gleicher ebene
                    $newid = $tree->addNode($folder_befor['id']);
                }
                // Update new created entry
                XT::query("
                    UPDATE
                        ". XT::getTable('mail_folders') . "
                    SET
                        attributes = '" . $val->attributes . "',
                        delimiter = '" . $val->delimiter . "',
                        title = '" . $title . "',
                        tree_id = '" . $account_id . "',
                        account_id = '" . $account_id . "',
                        path = '" . $path . "'
                    WHERE
                        id = '" . $newid . "'
                ",__FILE__,__LINE__);
            }
        }
        $path_befor = $path;
    }
}


// Search deleted Folders
reset($saved_folder);
reset($list);

$imap_folders = array();
while(list($key, $value) = each($list)) {
    $results = split('}',$value->name);
    $imap_folders[] = $results[1];
}

while (list($key, $value) = each ($saved_folder)){
     if (!in_array($value, $imap_folders)){
         $result = XT::query("
            SELECT 
                id 
            FROM 
                " . XT::getTable('mail_folders') ." 
            WHERE 
                account_id = '" . $account_id . "' AND 
                path = '" . $value . "'
            ",__FILE__,__LINE__);
        $ID = $result->FetchRow();
     }
}



if ($countNewMail > 0 OR $countDelMail > 0){
        echo "Sie haben " . $countNewMail . " neue Mail(s)! <br /> Und " . $countDelMail . " gelöschte Mail(s)";
} else {
    echo "Sie haben keine neuen und gelöschte Mails";
}
?>