<?php

if(XT::getPermission('settings')){

    // Buttons
    XT::addButton("Save settings", "saveSettings");
    XT::addButton("Reset settings", "resetSettings");

    if($GLOBALS['error']->getErrors() != array() AND $error[0]['severity'] < 8){

        XT::assign("INFOEMAIL", $GLOBALS['plugin']->getPostValue('infoemail'));
        XT::assign("EMAIL", $GLOBALS['plugin']->getPostValue('email'));
        XT::assign("CONFIRM", $GLOBALS['plugin']->getPostValue('confirm'));
        XT::assign("PAGESPLIT", $GLOBALS['plugin']->getPostValue('pagesplit'));
        XT::assign("HTML", $GLOBALS['plugin']->getPostValue('html'));
        XT::assign("HTMLTAGS", $GLOBALS['plugin']->getPostValue('htmltags'));
        XT::assign("EMOTICONS", $GLOBALS['plugin']->getPostValue('emoticons'));
        XT::assign("IPBLOCKING", $GLOBALS['plugin']->getPostValue('ipblocking'));
        XT::assign("IPBLOCKINGLIST", $GLOBALS['plugin']->getPostValue('ipblockinglist'));
        XT::assign("BADWORDS", $GLOBALS['plugin']->getPostValue('badwords'));
        XT::assign("BADWORDREPLACE", $GLOBALS['plugin']->getPostValue('badwordreplace'));
        XT::assign("BADWORDLIST", $GLOBALS['plugin']->getPostValue('badwordlist'));

    }else{

        XT::assign("INFOEMAIL", $GLOBALS['plugin']->getConfig('infoemail'));
        XT::assign("EMAIL", $GLOBALS['plugin']->getConfig('email'));
        XT::assign("CONFIRM", $GLOBALS['plugin']->getConfig('confirm'));
        XT::assign("PAGESPLIT", $GLOBALS['plugin']->getConfig('pagesplit'));
        XT::assign("HTML", $GLOBALS['plugin']->getConfig('html'));
        XT::assign("HTMLTAGS", $GLOBALS['plugin']->getConfig('htmltags'));
        XT::assign("EMOTICONS", $GLOBALS['plugin']->getConfig('emoticons'));
        XT::assign("IPBLOCKING", $GLOBALS['plugin']->getConfig('ipblocking'));
        XT::assign("IPBLOCKINGLIST", $GLOBALS['plugin']->getConfig('ipblockinglist'));
        XT::assign("BADWORDS", $GLOBALS['plugin']->getConfig('badwords'));
        XT::assign("BADWORDREPLACE", $GLOBALS['plugin']->getConfig('badwordreplace'));
        XT::assign("BADWORDLIST", $GLOBALS['plugin']->getConfig('badwordlist'));

    }

    $content = XT::build("editSettings.tpl");

}

?>