<?php

$GLOBALS['plugin']->contribute("ea_inline_navigation","shop_details", "Shop Details",1222);
// title
if($GLOBALS['plugin']->getValue('id')>0){
    $articleID = $GLOBALS['plugin']->getValue('id');
}else{
    $articleID = $GLOBALS['plugin']->getSessionValue('articleID');
}
// Get detailed information of the article
$result = XT::query("SELECT
               price,
               gift,
               product_of_month,
               buyable,
               taxes
           FROM
               " . $GLOBALS['plugin']->getTable('price') . "
           WHERE
               article_id=" . $articleID . " limit 1"
          ,__FILE__,__LINE__,0);

XT::assign("DATA",XT::getQueryData($result));

//Taxes
$result = XT::query("
    SELECT
        t.id,
        t.value
    FROM
        " . $GLOBALS['plugin']->getTable('taxes') . " as t
    WHERE
        t.value > 0
    ORDER BY
        t.value asc
    ",__FILE__,__LINE__,0);

while($row = $result->FetchRow()){
    $taxes[$row['id']] = $row['value'];
}

XT::assign("TAXES", $taxes);

//Staffelpreise
$result = XT::query("
    SELECT
       *
    FROM
        " . $GLOBALS['plugin']->getTable('staffelpreise') . "
    WHERE
       article_id=" . $articleID . "
    ORDER BY
       pcs asc
    ",__FILE__,__LINE__);

XT::assign("STAFFELPREISE", XT::getQueryData($result));

$GLOBALS['plugin']->contribute("ea_basic_datarows", XT::buildContribution("ea_basic_datarows.tpl"));

?>
