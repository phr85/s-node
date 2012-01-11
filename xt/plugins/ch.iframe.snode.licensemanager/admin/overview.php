<?php

if(is_numeric($GLOBALS['plugin']->getValue("product_id"))){
    $GLOBALS['plugin']->setSessionValue("product_id", $GLOBALS['plugin']->getValue("product_id"));
}

// Enable Char filter and navigator
XT::enableAdminCharFilter('title');
XT::enableAdminNavigator('licenses');

// Get users list
$result = XT::query("
    SELECT
        a.id,
        a.title,
        a.active,
        a.product_id,
        b.title as product_title
    FROM
        " . XT::getTable('licenses') . " as a LEFT JOIN
        " . XT::getTable('catalog_articles_details') . " as b ON (b.id = a.product_id AND b.lang = '" . $GLOBALS['plugin']->getActiveLang() . "') " . XT::getAdminCharFilter() . "
    GROUP BY
        a.product_id
    ORDER BY
        b.title ASC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    if($row['product_id'] == $GLOBALS['plugin']->getSessionValue("product_id")){
        $row['itw'] = true;
        XT::assign("PRODUCT_ID", $row['product_id']);
    } else {
        $row['itw'] = false;
    }
    $data[] = $row;
}
XT::assign("DATA", $data);

// Get licenses for product
if($GLOBALS['plugin']->getSessionValue("product_id") != ''){
    $result = XT::query("
        SELECT
            a.id,
            a.title,
            a.active,
            a.product_id,
            a.price
        FROM
            " . XT::getTable('licenses') . " as a
        WHERE
            a.product_id = '" . $GLOBALS['plugin']->getSessionValue("product_id") . "'
        ORDER BY
            a.title ASC
        LIMIT
            " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);
    
    $data = XT::getQueryData($result);
    XT::assign("LICENSES", $data);

}

$content = XT::build('overview.tpl');

?>