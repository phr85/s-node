<?php

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Parameter :: Category
$category = XT::getParam('category') != '' ? XT::getParam('category') : '1';

// Parameter :: Fields_rel
$field_ids = XT::getParam('fields_rel') != '' ? XT::getParam('fields_rel') : '1';

// Get categories
$result = XT::query("
    SELECT
        b.title,
        a.id
    FROM
        " . XT::getDatabasePrefix() . "catalog_tree as a LEFT JOIN
        " . XT::getDatabasePrefix() . "catalog_tree_nodes as b ON (b.node_id = a.id AND b.lang = '" . XT::getLang() . "')
    WHERE
        a.pid IN ("  . $category . ")
",__FILE__,__LINE__);

// Fetch Results
$categories = array();
while($row = $result->FetchRow()){
    $categories[] = $row;
}

XT::assign("CATEGORIES", $categories);

// Get field information
$result = XT::query("
    SELECT
        title,
        id
    FROM
        " . XT::getDatabasePrefix() . "catalog_articles_fields
    WHERE
        id IN (" . $field_ids . ")
",__FILE__,__LINE__);

// Fetch Results
$fields_rel = array();
while($row = $result->FetchRow()){
    $fields_rel[] = $row;
}

XT::assign("FIELDS", $fields_rel);

// Get field values
$result = XT::query("
    SELECT
        field_id,
        article_id,
        display
    FROM
        " . XT::getDatabasePrefix() . "catalog_articles_fields_rel
    WHERE
        field_id IN (" . $field_ids . ")
    GROUP BY
        display
    ORDER BY
        display ASC
",__FILE__,__LINE__);

// Fetch Results
$field_values = array();
while($row = $result->FetchRow()){
    $field_values[$row['field_id']][] = $row;
}

XT::assign("FIELD_VALUES", $field_values);

$content = XT::build($style);

?>