<?php

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
        images.image_id as image,
        files.type as image_type,
        shop.*
    FROM
        " . $GLOBALS['plugin']->getTable("catalog_articles_details") . " as ad
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("catalog_articles") . " as main ON(main.id = ad.id)
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("catalog_images") . "  as images ON(images.article_id = main.id AND images.is_main_image=1)
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files") . "  as files ON(files.id = images.image_id)
    LEFT JOIN " . XT::getTable("price") . " shop ON (main.id = shop.article_id)
    WHERE
        ad.lang='" . $GLOBALS['lang']->getLang() . "'
    AND
        ad.active=1
    AND
        ad.product_of_month=1"
    ,__FILE__,__LINE__,0);

$data = XT::getQueryData($result);
XT::assign("DATA", $data);


        $result = XT::query("
            SELECT node.article_id , node.node_id
            FROM
                " . $GLOBALS['plugin']->getTable("catalog_articles_details") . " as ad
            LEFT JOIN
                " . XT::gettable('catalog_tree_articles') . " as node on(ad.id = node.article_id)
            WHERE
                ad.lang='" . $GLOBALS['lang']->getLang() . "'
            AND
                ad.product_of_month=1

            ",__FILE__,__LINE__);

        $data = array();
        while($row = $result->FetchRow()){
            $nodes[$row['article_id']][] = $row['node_id'];
        }
XT::assign("NODES",$nodes);
// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);
?>