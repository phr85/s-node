<?php

XT::lock($GLOBALS['plugin']->getValue('id'), $GLOBALS['plugin']->getContentType('News'));

if($GLOBALS['plugin']->getValue("referer") != ''){
    $_SESSION['referer'] = $GLOBALS['plugin']->getValue("referer");
}

// Change to the edit mode of the News
$GLOBALS['plugin']->setAdminModule('e');
?>