<?php

if(count($_SESSION['BASKET']) >= 1){
    
if($GLOBALS['plugin']->getValue('action') == 'buy'){
    XT::assign("HIGHLIGHT", true);
} else {
    XT::assign("HIGHLIGHT", false);
}

if(isset($_SESSION['BASKET'])){
    $basket['sum'] = 0;
    $basket['articles'] = 0;
    foreach ($_SESSION['BASKET'] as $key => $value){
       $basket['sum'] += $value['price'] * $value['quantity'];
       $basket['articles'] += $value['quantity'];
       $basket['products'][$key] = $_SESSION['BASKET'][$key];
    }
}else{
   $basket['sum'] = 0;
   $basket['articles'] = 0;
}
    XT::assign("SIDENAV",$GLOBALS['plugin']->getConfig('sidenav'));
    XT::assign("BASKET", $basket);

// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);
}

?>