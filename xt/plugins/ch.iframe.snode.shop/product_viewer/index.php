<?php

$article_id = XT::autoval('article_id',"P",0,false,1200);

$result = XT::query("
    SELECT
        ad.id,
        ad.title,
        ad.subtitle,
        ad.lead,
        ad.description,
        ad.active,
        main.quantity,
        main.art_nr,
        shop.*
    FROM
        " . $GLOBALS['plugin']->getTable("catalog_articles_details") . " as ad
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("catalog_articles") . " as main ON(main.id = ad.id)
    LEFT JOIN " . XT::getTable("price") . " shop ON (main.id = shop.article_id)
    WHERE
        ad.lang='" . $GLOBALS['lang']->getLang() . "'
    AND
        ad.active=1
    AND
        main.id=" . $article_id
    ,__FILE__,__LINE__);

$data = XT::getQueryData($result);
XT::assign("DATA", $data[0]);

// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);
?>