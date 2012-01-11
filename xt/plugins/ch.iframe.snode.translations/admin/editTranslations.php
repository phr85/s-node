<?php
// Get package id (e.g. ch.iframe.snode.translations)
if(XT::getValue("package_id") != ''){
    XT::setSessionValue("package_id", XT::getValue("package_id"));
}

// Get package title (e.g. Translations)
if(XT::getValue("package_title") != ''){
    XT::setSessionValue("package_title", XT::getValue("package_title"));
}
// Get expression
if(XT::getValue("exp") != ''){
  echo   XT::setSessionValue("exp", stripslashes(XT::getValue("exp")));
}

// Add buttons
XT::addImageButton('Save','saveTranslation','default','disk_blue.png','0');

// Get language file
$plugin_messages = array();
$keys = array();

if(XT::getSessionValue('package_id') == 'global'){
    foreach($GLOBALS['cfg']->getLangs() as $key => $lang){
        if(is_file(ROOT_DIR . '/includes/lang/' . $key . '.lang.php')){
            include(ROOT_DIR . '/includes/lang/' . $key . '.lang.php');
            $trans[$key] = stripslashes($messages[$key][XT::getSessionValue('exp')]);
        }
    }
} else {
    foreach($GLOBALS['cfg']->getLangs() as $key => $lang){
        if(is_file(PLUGIN_DIR . XT::getSessionValue('package_id') . '/includes/lang/' . $key . '.lang.php')){
            include(PLUGIN_DIR . XT::getSessionValue('package_id') . '/includes/lang/' . $key . '.lang.php');
              $trans[$key] = $plugin_messages[$key][stripslashes(XT::getSessionValue('exp'))];
        }
    }
}

// Get languages
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("EXP", stripslashes(XT::getSessionValue('exp')));
XT::assign("TRANSLATION", $trans);
XT::assign("PACKAGE_TITLE", XT::getSessionValue('package_title'));

$content = XT::build('editTranslations.tpl');

?>