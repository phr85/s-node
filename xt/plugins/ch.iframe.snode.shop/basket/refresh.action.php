<?php
foreach ($GLOBALS['plugin']->getValue('quantity') as $article => $quantity){
    if(is_numeric($quantity) == true AND $quantity > 0){
        $_SESSION['BASKET'][$article]['quantity'] = $quantity;
    }else{
        $_SESSION['BASKET'][$article]['quantity'] = 1;
        $replace[0] = $quantity;
        $replace[1] = $article;
        $errormessage .= XT::translate_replace('wrong value (%1) in article %2',$replace) . ", " . XT::translate("value corrected to value 1") . "<br>";
    }
}
?>
