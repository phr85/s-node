<?php

// Save New Entry
// Check email
if($GLOBALS['plugin']->getPostValue('email') != ''){
    if(!XT::checkemail($GLOBALS['plugin']->getPostValue('email'))){
        XT::log("Invalid E-Mail address",__FILE__,__LINE__,XT_ERROR);
    }
}

// save operation
if(!XT::hasErrors()){
    XT::query("INSERT INTO " . XT::getTable('guestbook') . " (
        id,
        active,
        name,
        email,
        website,
        comment,
        ip,
        creation_date,
        creation_user
        ) VALUES (
        'NULL',
        1,
        '" . $GLOBALS['plugin']->getPostValue('name') . "',
        '" . $GLOBALS['plugin']->getPostValue('email') . "',
        '" . $GLOBALS['plugin']->getPostValue('website') . "',
        '" . $GLOBALS['plugin']->getPostValue('comment') . "',
        '" . getip() . "',
        '" . time() . "',
        '" . XT::getUserID() . "'
        )"
        ,__FILE__,__LINE__
        );

        XT::log("Your changes were successfully saved.",__FILE__,__LINE__,XT_INFO);
}
$GLOBALS['plugin']->setAdminModule('ae');
?>