<?php
// Save Settings
if($GLOBALS['plugin']->getPostValue('infoemail') == 1){
    if(!XT::checkemail($GLOBALS['plugin']->getPostValue('email'))){
        if(!$GLOBALS['usr']->userexist($GLOBALS['plugin']->getPostValue('email'))){
            XT::log("Invalid E-Mail address",__FILE__,__LINE__,XT_ERROR);
        }
    }
}

if(!is_numeric($GLOBALS['plugin']->getPostValue('pagesplit')) OR $GLOBALS['plugin']->getPostValue('pagesplit') < 1 OR $GLOBALS['plugin']->getPostValue('pagesplit') > 99){
    XT::log("Invalid pagesplit",__FILE__,__LINE__,XT_ERROR);
}

// save operation
if(!XT::hasErrors()){

    // sort IP-Blocking list
    $ablockid = array();
    $ablockid = split(';',$GLOBALS['plugin']->getPostValue('ipblockinglist'));

    sort($ablockid);

    $ipblocklist = '';
    $ipblocklistdb = '';
    foreach($ablockid as $key=>$value){
        if($value != ''){
            $ipblocklist = $ipblocklist . ";" . trim($value);
            // for update the db
            $ipblocklistdb = $ipblocklistdb . ",'" . trim($value) . "'";
        }
    }

    // sort bad word list
    $abadword = array();
    $abadword = split(';',$GLOBALS['plugin']->getPostValue('badwordlist'));

    sort($abadword);
    $badwordlist = '';
    foreach($abadword as $key=>$value){
        if($value != ''){
            $badwordlist = $badwordlist . ";" . trim($value);
        }
    }

    // Deactivate Entries with the new ip's
    if($ipblocklistdb != ''){
        XT::query("UPDATE " . $GLOBALS['plugin']->getTable('guestbook') . " SET blockip = '1' WHERE ip IN (" . substr($ipblocklistdb,1) . ")",__FILE__,__LINE__);
    }

    if($GLOBALS['plugin']->getPostValue('infoemail') == ''){$GLOBALS['plugin']->setPostValue('infoemail',0);}
    $configdata['infoemail'] = array('value' => $GLOBALS['plugin']->getPostValue('infoemail'), 'description' => 'info by email');
    $configdata['email'] = array('value' => $GLOBALS['plugin']->getPostValue('email'), 'description' => 'notifier email');
    if($GLOBALS['plugin']->getPostValue('confirm') == ''){$GLOBALS['plugin']->setPostValue('confirm',0);}
    $configdata['confirm'] = array('value' => $GLOBALS['plugin']->getPostValue('confirm'), 'description' => 'confirm entry');
    $configdata['pagesplit'] = array('value' => $GLOBALS['plugin']->getPostValue('pagesplit'), 'description' => 'pagesplit');
    if($GLOBALS['plugin']->getPostValue('html') == ''){$GLOBALS['plugin']->setPostValue('html',0);}
    $configdata['html'] = array('value' => $GLOBALS['plugin']->getPostValue('html'), 'description' => 'allow html');
    $configdata['htmltags'] = array('value' => $GLOBALS['plugin']->getPostValue('htmltags'), 'description' => 'allowed tags');
    if($GLOBALS['plugin']->getPostValue('emoticons') == ''){$GLOBALS['plugin']->setPostValue('emoticons',0);}
    $configdata['emoticons'] = array('value' => $GLOBALS['plugin']->getPostValue('emoticons'), 'description' => 'allow emoticons');
    if($GLOBALS['plugin']->getPostValue('ipblocking') == ''){$GLOBALS['plugin']->setPostValue('ipblocking',0);}
    $configdata['ipblocking'] = array('value' => $GLOBALS['plugin']->getPostValue('ipblocking'), 'description' => 'ipblocking');
    $configdata['ipblockinglist'] = array('value' => substr($ipblocklist,1), 'description' => 'ipblocking list');
    if($GLOBALS['plugin']->getPostValue('badwords') == ''){$GLOBALS['plugin']->setPostValue('badwords',0);}
    $configdata['badwords'] = array('value' => $GLOBALS['plugin']->getPostValue('badwords'), 'description' => 'bad words');
    $configdata['badwordreplace'] = array('value' => $GLOBALS['plugin']->getPostValue('badwordreplace'), 'description' => 'bad word replace');
    $configdata['badwordlist'] = array('value' => substr($badwordlist,1), 'description' => 'bad word list');

    $GLOBALS['cfg']->writeConfigFile($GLOBALS['plugin']->location . '../', $configdata);

    header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['tpl_id']);

}
?>