<?php

$product_count = 0;
foreach($_SESSION['BASKET'] as $product_id => $value){
    $product_count += $value['quantity'];
}

if ($product_count <= 0) {

$GLOBALS['plugin']->setSessionValue('OPSTEP',1);
    $op  = $GLOBALS['plugin']->getConfig("orderprocess");
    header("Location:" . $_SERVER['PHP_SELF'] . "?TPL=" . $op[1]['tpl']);
}

if($GLOBALS['auth']->isAuth()){

    // Adresse holen und assignen
    $result = XT::query("SELECT * FROM " . XT::getTable('customers') . " WHERE id=" . XT::getSessionValue('shipping_address') . " AND user_id =" . $_SESSION['user']['id'],__FILE__,__LINE__,0);
    $address['shipping'] = XT::getQueryData($result);

    $result = XT::query("SELECT * FROM " . XT::getTable('customers') . " WHERE id=" . XT::getSessionValue('billing_address') . " AND user_id =" . $_SESSION['user']['id'],__FILE__,__LINE__,0);
    $address['billing'] = XT::getQueryData($result);

    XT::assign("USERNAME",$_SESSION['user']['name']);
    XT::assign("ADDRESS",$address);

}

unset($errormessage);
if($GLOBALS['plugin']->getValue('action') !=""){
    include($GLOBALS['plugin']->getValue('action') . ".action.php");
}

if(!isset($_SESSION['BASKET'])){
    $_SESSION['BASKET'] = array();
}

if(count($_SESSION['BASKET']) > 0){

    //Warenkorb
    include(PLUGIN_DIR . "ch.iframe.snode.shop/includes/shared/basket.php");
    // Geschenke
    include(PLUGIN_DIR . "ch.iframe.snode.shop/includes/shared/gift.php");

}


// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}

$content = XT::build($style);
?>