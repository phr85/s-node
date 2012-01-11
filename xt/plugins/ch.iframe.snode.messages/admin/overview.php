<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

if(XT::getPermission('list')){

// Enable admin navigator
XT::enableAdminNavigator('messages', 'id', "
    SELECT count(a.id) FROM
        " . XT::getTable('messages') . " as a,
        " . XT::getTable('user') . " as b
    WHERE
        a.receiver = " . XT::getUserID() . "
        AND b.id = a.sender
        AND deleted = 0
    ORDER BY
        send_date DESC
    ");

// Get all received messages
$result = XT::query("
    SELECT
        a.id, b.username, a.subject, a.receiver, a.read_date, a.send_date, a.priority
    FROM
        " . XT::getTable('messages') . " as a,
        " . XT::getTable('user') . " as b
    WHERE
        a.receiver = " . XT::getUserID() . "
        AND b.id = a.sender
        AND deleted = 0
    ORDER BY
        send_date DESC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);

XT::assign("DATA", XT::getQueryData($result));

// Fetch content
$content = XT::build("overview.tpl");

}

?>