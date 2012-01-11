<?php

// Save Entry

// save operation
	
    XT::query("UPDATE " . XT::getTable('guestbook') . " SET
        name = '" . $GLOBALS['plugin']->getPostValue('name') . "'
        , email = '" . $GLOBALS['plugin']->getPostValue('email') . "'
        , website = '" . $GLOBALS['plugin']->getPostValue('website') . "'
        , comment = '" . $GLOBALS['plugin']->getPostValue('comment') . "'
        , ip = '" . getip() . "'
        , mod_date = '" . time() . "'
        , mod_user = '" . XT::getUserID() . "'
        WHERE id = " . $GLOBALS['plugin']->getValue('id')
        ,__FILE__,__LINE__,0
        );

    XT::log("Your changes were successfully saved.",__FILE__,__LINE__,XT_INFO);



$GLOBALS['plugin']->setAdminModule('o');
?>