<?php

// Bestellung holen
$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("shop_orders") . "
    WHERE
        id=" . XT::getValue('ordrnr') . "
AND user_id=" . XT::getUserID() . "
    ORDER BY
        id DESC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
",__FILE__,__LINE__);


$data = array();
while($row = $result->FetchRow()){
    $data['order'] = $row;
$havedata = true;
}
if($havedata){
    // Bestelldetails holen
    $result = XT::query("select od.*, ad.title, prod.price as realprice from " . XT::getTable('order_details') . " as od
LEFT JOIN
" . XT::getTable('articles_details') . " as ad ON (ad.id = od.product_id AND ad.lang = '" . XT::getPluginLang() . "')
LEFT JOIN
" . XT::getTable('prices') . " as prod ON (prod.article_id = od.product_id)
WHERE od.order_id=" . XT::getValue('ordrnr'),__FILE__,__LINE__);
    while($row = $result->FetchRow()){
        $data['order_details'][] = $row;
        $data['total'] += ($row['realprice'] * $row['quantity']);
    }
    $data['total'] += $data['order']['transport'];
    // Adresse Holen
    $result = XT::query("SELECT * from " . $GLOBALS['plugin']->getTable("customers_persons") . "  WHERE id = " . $data['order']['user_id'] ,__FILE__,__LINE__);
    while($row = $result->FetchRow()){
        $data['customer'] = $row;
    }
}


XT::assign("DATA", $data);

$content = XT::build("default.tpl");
?>