<?php
// Save Options

if($GLOBALS['plugin']->getPostValue('forwardtoemail') == 1){
    if(!XT::checkEmail($GLOBALS['plugin']->getPostValue('email'))){
        XT::log("Invalid E-Mail address",__FILE__,__LINE__,XT_ERROR);
    }
} elseif ($GLOBALS['plugin']->getPostValue('email') != ''){
    if(!XT::checkEmail($GLOBALS['plugin']->getPostValue('email'))){
        XT::log("Invalid E-Mail address",__FILE__,__LINE__,XT_ERROR);
    }
}

// save operation
if(!XT::hasErrors()){

    if($GLOBALS['plugin']->getPostValue('forwardtoemail') == ''){$GLOBALS['plugin']->setPostValue('forwardtoemail',0);}
    $configdata['forwardtoemail'] = array('value' => $GLOBALS['plugin']->getPostValue('forwardtoemail'), 'description' => 'forward messages to email');
    $configdata['email'] = array('value' => $GLOBALS['plugin']->getPostValue('email'), 'description' => 'notifier email');

    $GLOBALS['cfg']->writeConfigFile($GLOBALS['plugin']->location . '../', $configdata);

    //header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['tpl_id'] . "&module=eo");

}

?>