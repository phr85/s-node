<?php
// Get expression
if(XT::getValue("exp") != ''){
  echo   XT::setSessionValue("exp", stripslashes(XT::getValue("exp")));
}

// Add buttons
XT::addImageButton('Save','saveTranslation','default','disk_blue.png','0','','s','','opener.document.location.reload();');
XT::addImageButton('Save and close','saveTranslation2','default','save_close.png','0','','x','','opener.document.location.href=opener.document.location.href;window.close();');
XT::addImageButton('Close','closewindow','default','exit.png','0','','x','','window.close();');

// Get language file
$plugin_messages = array();
$keys = array();

if($_REQUEST['package']== ''){
    foreach($GLOBALS['cfg']->getLangs() as $key => $lang){
        if(is_file(ROOT_DIR . '/includes/lang/' . $key . '.lang.php')){
            include(ROOT_DIR . '/includes/lang/' . $key . '.lang.php');
            $trans[$key] = stripslashes($messages[$key][$_REQUEST["msg"]]);
        }
    }
    XT::setSessionValue("package_id","global");
} else {
    foreach($GLOBALS['cfg']->getLangs() as $key => $lang){
        if(is_file(PLUGIN_DIR . $_REQUEST['package'] . '/includes/lang/' . $key . '.lang.php')){
            include(PLUGIN_DIR . $_REQUEST['package'] . '/includes/lang/' . $key . '.lang.php');
              $trans[$key] = $plugin_messages[$key][stripslashes($_REQUEST["msg"])];
        }
    }
    XT::setSessionValue("package_id",$_REQUEST['package']);
}

// Get languages
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("EXP", stripslashes($_REQUEST["msg"]));
XT::assign("TRANSLATION", $trans);
XT::assign("PACKAGE_TITLE", $_REQUEST['package']);
$content = XT::build(XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl');
?>