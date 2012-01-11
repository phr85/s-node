<?php

switch($GLOBALS['plugin']->getPostValue('action')){

    // Save New Entry
    case 'saveEntry':

        // Info E-Mail
        if($GLOBALS['plugin']->getConfig('infoemail') == 1){
            // Send email to Admin
            $GLOBALS['preplugin_content'] .= "send email to " . $GLOBALS['plugin']->getConfig('email');
        }

        // Confirm Entry
        $active = 1;
        if($GLOBALS['plugin']->getConfig('confirm') == 1){
            $active = 0;
        }

        // StripTags Comment
        if($GLOBALS['plugin']->getConfig('html') == 1){
            $GLOBALS['plugin']->setPostValue('comment', strip_tags($GLOBALS['plugin']->getPostValue('comment'), $GLOBALS['plugin']->getConfig('tags')));
        }else{
            $GLOBALS['plugin']->setPostValue('comment', htmlentities(strip_tags($GLOBALS['plugin']->getPostValue('comment'))));
        }

        // Emoticons
        if($GLOBALS['plugin']->getConfig('emoticons') == 1){

        }

        // IP Blocking
        if($GLOBALS['plugin']->getConfig('ipblocking') == 1){
            $ablockid = split(';',$GLOBALS['plugin']->getConfig('ipblockinglist'));
            if(in_array(getip(),$ablockid)){
                XT::log("IP is blocked!",__FILE__,__LINE__,XT_ERROR);
            }
        }

        // Check email
        if($GLOBALS['plugin']->getPostValue('email') != ''){
            if(!checkemail($GLOBALS['plugin']->getPostValue('email'))){

            }
        }

        // save operation
        if(!XT::hasErrors()){
            XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('guestbook') . " (
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
                '" . $active . "',
                '" . strip_tags($GLOBALS['plugin']->getPostValue('name')) . "',
                '" . strip_tags($GLOBALS['plugin']->getPostValue('email')) . "',
                '" . strip_tags($GLOBALS['plugin']->getPostValue('website')) . "',
                '" . $GLOBALS['plugin']->getPostValue('comment') . "',
                '" . getip() . "',
                '" . time() . "',
                '" . XT::getUserID() . "'
                )"
                ,__FILE__,__LINE__
                );

                XT::log("Your changes were successfully saved.",__FILE__,__LINE__,XT_INFO);
        }else{

        }

        break;
}
?>