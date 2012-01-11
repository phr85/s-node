<?php

// Get new order and total order count
$result = XT::query("
    SELECT
        count(id) as count_id,
        sum(endprice) as count_prices
    FROM
        " . $GLOBALS['plugin']->getTable("orders") . "
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;   
}

$total_order_count = $data[0]['count_id'];
$total_price_count = $data[0]['count_prices'];
XT::assign("TOTAL_ORDER_COUNT", $total_order_count);
XT::assign("TOTAL_PRICE_COUNT", $total_price_count);

$result = XT::query("
    SELECT
        count(id) as count_id
    FROM
        " . $GLOBALS['plugin']->getTable("orders") . "
    WHERE
        status = 0
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;   
}

$new_order_count = $data[0]['count_id'];
XT::assign("NEW_ORDER_COUNT", $new_order_count);

$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("orders") . "
    ORDER BY
        creation_date DESC
    LIMIT 1
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;   
}

XT::assign("LAST_ORDER", $data[0]);

$content = XT::build("default.tpl");

?>
