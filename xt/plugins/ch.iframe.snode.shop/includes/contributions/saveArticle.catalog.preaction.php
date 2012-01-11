<?php
$StaffelpreisPrice = XT::getValue('SPprice');
$StaffelpreisPcs = XT::getValue('SPpcs');

foreach ($StaffelpreisPrice as $SPkey => $SPvalue) {

    //Staffelpreis aktualisieren
    if($StaffelpreisPcs[$SPkey] > 0 && $SPvalue > 0){
        if($SPkey=="new"){
            XT::query("INSERT into " . XT::getTable("staffelpreise") . " SET pcs=" . $StaffelpreisPcs[$SPkey] . " , price='" . $SPvalue . "', article_id=" . XT::getValue('id') ,__FILE__,__LINE__);
        }else {
            XT::query("UPDATE " . XT::getTable("staffelpreise") . " SET pcs=" . $StaffelpreisPcs[$SPkey] . " , price='" . $SPvalue . "' WHERE id = " . $SPkey,__FILE__,__LINE__);
        }
    }else {
    	if($SPkey!="new"){
    	    XT::query("DELETE from " . XT::getTable("staffelpreise") . " WHERE id = " . $SPkey,__FILE__,__LINE__,1);
    	}
    }

}

/**
 * save
 */
$result = XT::query("SELECT
                         count(article_id) as id
                     FROM
                         " . $GLOBALS['plugin']->getTable('price') . "
           WHERE
               article_id=" . $GLOBALS['plugin']->getValue('id')
,__FILE__,__LINE__,0);
$row = $result->FetchRow();
if($GLOBALS['plugin']->getValue('product_of_month') == 1){
    XT::query("UPDATE " . $GLOBALS['plugin']->getTable('price') . "
               SET product_of_month= 0"
    ,__FILE__,__LINE__);

}

if($row['id'] > 0){
    // if exists update
    XT::query("UPDATE " . $GLOBALS['plugin']->getTable('price') . "
               SET
                   price= '" . $GLOBALS['plugin']->getValue('price') . "',
                   gift= '" . $GLOBALS['plugin']->getValue('gift') . "',
                   taxes= '" . $GLOBALS['plugin']->getValue('taxes') . "',
                   buyable= '" . $GLOBALS['plugin']->getValue('buyable') . "',
                   product_of_month= '" . $GLOBALS['plugin']->getValue('product_of_month') . "'
              WHERE
                   article_id=" . $GLOBALS['plugin']->getValue('id')
    ,__FILE__,__LINE__);
}else{
    // else insert
    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('price') . "
                  (article_id, price, gift, taxes, buyable, product_of_month)
              VALUES (
                  " . $GLOBALS['plugin']->getValue('id') . ",
                  '" . $GLOBALS['plugin']->getValue('price') . "',
                  '" . $GLOBALS['plugin']->getValue('gift') . "',
                  '" . $GLOBALS['plugin']->getValue('taxes') . "',
                  '" . $GLOBALS['plugin']->getValue('buyable') . "',
                  '" . $GLOBALS['plugin']->getValue('product_of_month') . "'
                  )",__FILE__,__LINE__);
}

?>
