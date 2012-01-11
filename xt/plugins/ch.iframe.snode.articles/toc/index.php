<?php
// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Parameter :: Category
$category = XT::getParam('category') != '' ? XT::getParam('category') : '0';


$categories = array();
if($category > 0) {

    $result = XT::query("
        SELECT
            d.title,
            d.description,
            d.node_id,
            b.id
        FROM
            " . XT::getTable('articles_tree') . " as a,
            " . XT::getTable('articles_tree') . " as b LEFT JOIN
            " . XT::getTable('articles_tree_details') . " as d ON (d.node_id = b.id AND d.lang = '" . $GLOBALS['lang']->getLang() . "')
        WHERE 
            a.id IN (" . $category . ") AND
            b.l > a.l AND b.r < a.r
        ORDER BY
            b.l ASC
    ", __FILE__, __LINE__);

    while ($row = $result->fetchRow()) {
        $categories[$row['node_id']] = $row;
    }
    
    XT::assign("CATEGORIES", $categories);
}

$sql = "
    SELECT
        n.id,
        n.title,
        n.creation_date,
        n.active,
        n.image,
        n.image_version,
        a.node_id
    FROM
        " . XT::getTable('articles_tree_rel') . " as a LEFT JOIN
        " . XT::getTable('articles') . " as n ON (n.id = a.article_id AND n.lang = '" . $GLOBALS['lang']->getLang() . "')
    WHERE
        n.active = 1
    AND
        (n.display_time_start = 0 OR n.display_time_start < " . time() . ")
    AND
        (n.display_time_end = 0 OR n.display_time_end > " . time() . ")"

;
    if($ids != '0'){
        $sql .= " AND a.node_id IN (" . implode(',',array_keys($categories)) . ") ";
    }
    $sql .= " ORDER BY
        n.creation_date DESC";


$result = XT::query($sql,__FILE__,__LINE__);

$articles = array();
while($row = $result->FetchRow()){
    $articles[$row['node_id']][] = $row;
}

XT::assign("ARTICLES", $articles);
XT::assign("ADMIN_TPL", $GLOBALS['plugin']->getConfig('admin_tpl'));

$content = XT::build($style);

?>
