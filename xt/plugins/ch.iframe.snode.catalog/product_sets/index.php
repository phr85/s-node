<?php
// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

// Get article id
$article_id = XT::autoval("article_id","R");
//$GLOBALS['plugin']->getValue("article_id") == "" ? $GLOBALS['plugin']->getSessionValue("article_id") : $GLOBALS['plugin']->getValue("article_id");

// Check for id
$article_id = $article_id == "" ? 0 : $article_id;

if($article_id != 0) {
    $result = XT::query("
        SELECT
            tn.title
        FROM
            " . $GLOBALS['plugin']->getTable('tree2articles') . " as ta
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable('nodes') . " as tn
        ON
            (ta.node_id=tn.node_id)

        WHERE
            ta.article_id=" . $article_id
        ,__FILE__, __LINE__);

    $row = $result->fetchRow();
    XT::assign('CATEGORY_TITLE', $row['title']);
}

$result = XT::query("
        SELECT
            article_id
        FROM
            " . $GLOBALS['plugin']->getTable("articles_set") . "
        WHERE
            main_article_id=" . $article_id . "
        ORDER BY
            position ASC
", __FILE__,__LINE__);

$ids = array();

while ($row = $result->fetchRow()) {
	$ids[] = $row['article_id'];
}

$ids = implode(',', $ids);

if ($ids == "") {
	$ids = "0";
}

// werte holen
$result = XT::query("
    SELECT
      det.*,
      art.*
    FROM
        " . XT::getTable("articles_details") . " as det
    LEFT JOIN " . XT::getTable("articles") . " as art ON det.id = art.id
    WHERE
        art.id IN(" . $ids. ")
    AND
        det.lang='" . XT::getLang() . "'
",__FILE__,__LINE__);

XT::assign("SET", XT::getQueryData($result));
$content = XT::build($style);
?>