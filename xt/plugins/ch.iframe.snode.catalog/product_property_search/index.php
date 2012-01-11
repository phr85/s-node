<?php
//echo '<pre>' . print_r($_POST, true) . '</pre>';

// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

// Parameter :: fields_rel
$fields = $GLOBALS['plugin']->getParam('fields') != '' ? $GLOBALS['plugin']->getParam('fields') : 'all';

// Get all fields
$result = XT::query("
    SELECT
        id,
        title
    FROM
        " . XT::getTable("fields")  . "
    WHERE
        lang='" . XT::getLang() . "'
    ORDER BY
        title 
    ASC
",__FILE__,__LINE__);

$fields = XT::getQueryData($result);
XT::assign('FIELDS', $fields);

// Get all categories

$result = XT::query("
    SELECT
        node_id,
        title
    FROM
        " . XT::getTable("nodes")  . "
    WHERE
        node_id > 1 AND
        lang = '" . XT::getLang() . "' AND
        public = 1 AND
        active = 1
",__FILE__,__LINE__);

$categories = XT::getQueryData($result);
XT::assign("CATEGORIES", $categories);

XT::assign("CATEGORY_SELECTED", XT::getValue("category"));
XT::assign("FIELD_SELECTED", XT::getValue("field"));

if (XT::getValue("category")  != "" && 
    XT::getValue("field")     != "" && 
    XT::getValue("searchfor") != "") {
        
    $result = XT::query("
        SELECT
        	tree_articles.article_id,
        	articles_details.title,
        	articles_details.lead
        FROM
        	" . XT::getTable("tree2articles") . " AS tree_articles
        LEFT JOIN
        	" . XT::getTable("fields_rel") . " AS articles_fields
        ON
        	(tree_articles.article_id = articles_fields.article_id)
        LEFT JOIN
        	" . XT::getTable("articles_details") . " AS articles_details
        ON
        	(articles_details.id = tree_articles.article_id)
        WHERE
        	articles_fields.field_id=" . XT::getValue("field") . "
        AND
        	tree_articles.node_id=" . XT::getValue("category") . "
        AND 
            articles_fields.display LIKE '%" . XT::getValue("searchfor") . "%'
        ",__FILE__,__LINE__);
    
    XT::assign("RESULTS", XT::getQueryData($result));
    XT::assign("RESULTS_COUNT", $result->recordCount());
    XT::assign('SEARCH_FOR',XT::getValue("searchfor"));
}

$content = XT::build($style);
?>