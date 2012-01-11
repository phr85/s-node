<?php
$op  = $GLOBALS['plugin']->getConfig("orderprocess");

if($GLOBALS['plugin']->getSessionValue('OPSTEP') < 1){
    $GLOBALS['plugin']->setSessionValue('OPSTEP',1);
}

XT::assign("ORDER_ID", $GLOBALS['plugin']->getValue("order_id"));
XT::assign("OPSTEP", $GLOBALS['plugin']->getSessionValue('OPSTEP'));

 XT::assign("PROCESS", $op);
    // Fetch content
    if($GLOBALS['plugin']->getParam("style") != ""){
        $style = $GLOBALS['plugin']->getParam("style");
    }else{
        $style = "default.tpl";
    }
    $content = XT::build($style);
?>