<?php

// include language handling class
XT::loadClass('lang.class.php','ch.iframe.snode.translations');

// Allow language switch with a get variable
if(isset($_GET['lang']) && strlen($_GET['lang']) == 2){
    $language = addslashes($_GET['lang']);
    $_SESSION['user']['lang'] = $language;
}

if(isset($_GET['tmp_lang'])){
    $lang = new XT_Lang(addslashes($_GET['tmp_lang']));
} else {

	$lang = new XT_Lang($_SESSION['user']['lang']);
    if(!isset($_SESSION['user']['lang'])){
        $_SESSION['user']['lang'] = $lang->preffered_lang;
    }
}

// unset unused variables
unset($language);

?>