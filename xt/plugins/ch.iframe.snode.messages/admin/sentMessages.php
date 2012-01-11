<?php

if(XT::getPermission('list')){
    
// Add buttons
XT::addButton("Write message", "writeMessage");

// Enable admin navigator
XT::enableAdminNavigator('messages', 'id', "
    SELECT count(a.id) FROM 
        " . XT::getTable('messages') . " as a,
        " . XT::getTable('user') . " as b
    WHERE
        a.sender = " . XT::getUserID() . "
        AND b.id = a.receiver
        AND deleted = 0
    ORDER BY
        send_date DESC
    ",__FILE__,__LINE__);

// Get all sent messages
$result = XT::query("
    SELECT 
        a.id, b.username, a.subject, a.receiver, a.read_date, a.send_date, a.priority
    FROM 
        " . XT::getTable('messages') . " as a,
        " . XT::getTable('user') . " as b
    WHERE
        a.sender = " . XT::getUserID() . "
        AND b.id = a.receiver
        AND deleted = 0
    ORDER BY
        send_date DESC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);

XT::assign("DATA", XT::getQueryData($result));

// Fetch content
$content = XT::build("sentMessages.tpl");

}

?>