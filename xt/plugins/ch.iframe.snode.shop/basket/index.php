<?php

unset($errormessage);
if($GLOBALS['plugin']->getValue('action') !="" && $GLOBALS['plugin']->getValue('action') != "buy"){
//if($GLOBALS['plugin']->getValue('action') !=""){
    include($GLOBALS['plugin']->getValue('action') . ".action.php");
}

if(!isset($_SESSION['BASKET'])){
    $_SESSION['BASKET'] = array();
}

if(count($_SESSION['BASKET']) > 0){


    include(PLUGIN_DIR . "ch.iframe.snode.shop/includes/shared/basket.php");

    include(PLUGIN_DIR . "ch.iframe.snode.shop/includes/shared/gift.php");

    // Fetch content
    if($GLOBALS['plugin']->getParam("style") != ""){
        $style = $GLOBALS['plugin']->getParam("style");
    }else{
        $style = "default.tpl";
    }
    $content = XT::build($style);
}
?>