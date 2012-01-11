<?php
if(!isset($_SESSION['ASSIGN']['SHOP']['baseId'])){
    $shop['baseId'] = $GLOBALS['plugin']->getBaseID();
    $shop['catalog']['baseId'] = $GLOBALS['plugin']->getConfig("catalogBaseId");
    $shop['catalog']['article_details_tpl'] = $GLOBALS['plugin']->getConfig("article_details_tpl");
    XT::assign_permanent("SHOP", $shop);
    XT::assign_permanent("BASECURRENCY", $GLOBALS['plugin']->getConfig("base_currency"));

    $op = $GLOBALS['plugin']->getConfig('orderprocess');
    XT::assign_permanent("BASKETTPL", $op[1]['tpl'] );
}

if(in_array($_SESSION['COUNTRY'],$GLOBALS['plugin']->getConfig('allowed_countries'))){
    XT::assign_permanent("SHOPENABLED", "1");
}else {
    
    XT::assign_permanent("SHOPENABLED", "1");
}

XT::assign_permanent('BASECURRENCY',XT::getConfig('base_currency'));
// add buyed ammount to basket
if($GLOBALS['plugin']->getValue('buy') > 0){
        
    if(!isset($_SESSION['BASKET'][$GLOBALS['plugin']->getValue('product_id')])){
        $_SESSION['BASKET'][$GLOBALS['plugin']->getValue('product_id')]['quantity'] = $GLOBALS['plugin']->getValue('buy');
        $_SESSION['BASKET'][$GLOBALS['plugin']->getValue('product_id')]['image_id'] = $GLOBALS['plugin']->getValue('image_id');
        $_SESSION['BASKET'][$GLOBALS['plugin']->getValue('product_id')]['image_version'] = $GLOBALS['plugin']->getValue('image_version');
        $_SESSION['BASKET'][$GLOBALS['plugin']->getValue('product_id')]['price'] = XT::round5($GLOBALS['plugin']->getValue('price'));
        $_SESSION['BASKET'][$GLOBALS['plugin']->getValue('product_id')]['title'] = $GLOBALS['plugin']->getValue('title');
    }else{
        $_SESSION['BASKET'][$GLOBALS['plugin']->getValue('product_id')]['quantity'] += $GLOBALS['plugin']->getValue('buy');
    }
    
	// Preis holen (Staffelpreise checken)                                                                                       
        $staffel = XT::getQueryData(XT::query("SELECT pcs,price from " . XT::getTable("staffelpreise") . " WHERE article_id= " .  XT::getValue('product_id'),__FILE__,__LINE__),"pcs");
        $gesamtmenge = $_SESSION['BASKET'][XT::getValue('product_id')]['quantity'] += $anzahl;                                       
        foreach ($staffel as $sp) {                                                                                                  
            if( $gesamtmenge >= $sp['pcs']){                                                                                         
                $preis = $sp['price'];                                                                                               
            }                                                                                                                        
        }                                                                                                                            
        $_SESSION['BASKET'][XT::getValue('product_id')]['quantity'] = $gesamtmenge;    
        
}
//$content =  '<meta name="shop" content="enabled" />';
?>