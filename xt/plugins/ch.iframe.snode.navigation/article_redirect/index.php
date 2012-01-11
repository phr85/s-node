<?php

$result = XT::query("
    SELECT
        node_id
    FROM 
        " . $GLOBALS['plugin']->getTable("navigation_details") . " 
    WHERE
        article_id = '" . $GLOBALS['plugin']->getValue("article_id") . "'
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

if(count($data) > 0){
    header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $data[0]['node_id'] . "");
} else {
    header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['plugin']->getConfig("article_viewer_tpl") . "&x" . $GLOBALS['plugin']->getConfig("articles_baseid") . "_id=" . $GLOBALS['plugin']->getValue("article_id"));
}

?>