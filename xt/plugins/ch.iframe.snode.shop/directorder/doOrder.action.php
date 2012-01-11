<?php

include('getProduct.action.php');

include_once(CLASS_DIR . "shop.class.php");
$shop = new XT_Shop();

foreach($_SESSION['shop']['direct'] as $key => $value){
    $shop->buy($value['id'],$value['image_id'],$value['image_version'],$value['price'],$value['quantity']);
}
$_SESSION['shop']['direct'] = array();
header("Location:" . $_SERVER['PHP_SELF'] . "?TPL=" . $op[1]['tpl']);
?>