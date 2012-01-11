<?php

XT::enableAdminNavigator('shop_orders');

$result = XT::query("
    SELECT
        a.id,
        a.order_no,
        a.user_id,
        a.session_id,
        a.creation_date,
        a.transport,
        a.discount,
        a.totalprice,
        a.endprice,
        a.taxes,
        a.gifts,
        a.products,
        a.products_count,
        a.status,
        b.firstName,
        b.lastName,
        b.id as customer_id
    FROM
        " . $GLOBALS['plugin']->getTable("shop_orders") . " as a LEFT JOIN
        " . $GLOBALS['plugin']->getTable("customers_persons") . " as b ON (b.id = a.user_id)
    WHERE a.user_id = " . XT::getUserID() . "
    ORDER BY
        a.id DESC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}
XT::assign("DATA", $data);

$content = XT::build("default.tpl");

?>