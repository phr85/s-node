<?php

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Parameter :: Category (Default: Root node)
$category = XT::getParam('category') != '' ? XT::getParam('category') : '1';

// Parameter :: Limit (Default: No limit)
$limit = XT::getParam('limit') != '' ? XT::getParam('limit') : '0';
if($limit > 0){
    $additional = 'LIMIT ' . $limit;
}

// Get elements for given category
$result = XT::query("
    SELECT
        b.id,
        b.title,
        b.lead,
        c.image_id
    FROM
        " . XT::getDatabasePrefix() . "catalog_tree_articles as a LEFT JOIN
        " . XT::getDatabasePrefix() . "catalog_articles_details as b ON (b.id = a.article_id AND b.lang = '" . XT::getLang() . "') LEFT JOIN
        " . XT::getDatabasePrefix() . "catalog_articles_images as c ON (c.article_id = b.id AND is_main_image = 1)
    WHERE
        a.node_id IN (" . $category . ")
    " . $additional . "
",__FILE__,__LINE__);

$products = array();
while($row = $result->FetchRow()){
    $products[] = $row;
}

XT::assign("PRODUCTS", $products);

$content = XT::build($style);

?>