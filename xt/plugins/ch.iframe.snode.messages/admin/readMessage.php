<?php

if($GLOBALS['plugin']->getValue("id") != ''){
    $GLOBALS['plugin']->setSessionValue("id", $GLOBALS['plugin']->getValue("id"));
}

if(XT::getPermission('read')){

// Add buttons
if(XT::getPermission('reply')){
    $GLOBALS['plugin']->contribute("view_buttons", "Reply", "replyMessage","mail_out.png","readmessage");
}
if(XT::getPermission('forward')){
    $GLOBALS['plugin']->contribute("view_buttons", "Forward", "forwardMessage","mail_forward.png","readmessage");
}

$result = XT::query("
    SELECT
        a.id, b.username, a.subject, a.receiver, a.read_date, a.send_date, a.priority, a.text, a.sender, a.message_flow
    FROM
        " . XT::getTable('messages') . " as a,
        " . XT::getTable('user') . " as b
    WHERE
        a.id = " . $GLOBALS['plugin']->getSessionValue("id") . "
        AND (a.sender = " . XT::getUserID() . " OR a.receiver = " . XT::getUserID() . ")
        AND b.id = a.sender
    LIMIT
        1
    ",__FILE__,__LINE__);

$data = XT::getQueryData($result);

// If logged in user is the receiver
if($data[0]['receiver'] == $GLOBALS['auth']->getUserId() && XT::getPermission('delete')){
    $GLOBALS['plugin']->contribute("view_buttons", "Delete", "deleteMessage","mail_delete.png","readmessage");
    XT::query("UPDATE " . XT::getTable("messages") . " SET read_date = " . time() . " WHERE id = " . $GLOBALS['plugin']->getSessionValue("id"),__FILE__,__LINE__);
}

XT::assign("MAIL", $data[0]);

// Get message flow entries
$result = XT::query("
    SELECT
        a.id, b.username as s_username, c.username as r_username, a.subject, a.receiver, a.read_date, a.send_date, a.priority, a.sender
    FROM
        " . XT::getTable('messages') . " as a,
        " . XT::getTable('user') . " as b,
        " . XT::getTable('user') . " as c
    WHERE
        (a.id = " . $data[0]['id'] . " OR
        (((a.message_flow = " . $data[0]['message_flow'] . " AND a.message_flow != 0) OR a.id = " . $data[0]['message_flow'] . ")
        OR a.message_flow = " . $data[0]['id'] . "))
        AND (a.sender = " . XT::getUserID() . " OR a.receiver = " . XT::getUserID() . ")
        AND b.id = a.sender
        AND c.id = a.receiver
        AND deleted = 0
    ORDER BY
        a.send_date DESC
    ",__FILE__,__LINE__);

XT::assign("FLOW_MESSAGES", XT::getQueryData($result));

// Fetch content
$content = XT::build("readMessage.tpl");

}

?>