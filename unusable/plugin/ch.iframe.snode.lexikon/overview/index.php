<?php
// set And get session values
if(!$GLOBALS['plugin']->getValue('node_id')){
    $GLOBALS['plugin']->setValue('node_id', $GLOBALS['plugin']->getSessionValue('node_id'));
}else{
    $GLOBALS['plugin']->setSessionValue('node_id',$GLOBALS['plugin']->getValue('node_id'));
}
$result = XT::query("
    SELECT
        ad.id,
        img.image_id,
        img.image_version,
        ad.title,
        ad.lead,
        ad.active,
        f.value as field_text,
        main.quantity,
        main.art_nr,
        p.price
    FROM
        " . $GLOBALS['plugin']->getTable("articles_details") . " as ad
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("tree2articles") . " as tar ON(tar.article_id = ad.id)
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("images") . " as img ON (img.article_id = ad.id AND img.is_main_image = 1)
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("articles") . " as main ON(main.id = ad.id)
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("shop_articles") . " as p ON(p.article_id = ad.id)
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("fields") . " as f ON(f.article_id = ad.id AND f.lang='" . $GLOBALS['lang']->getLang() . "' AND f.fieldname_id=" . $GLOBALS['plugin']->getParam("field_id") . ")
    WHERE
        ad.lang='" . $GLOBALS['lang']->getLang() . "'
    AND
        ad.active=1
    AND
        tar.node_id=" . $GLOBALS['plugin']->getSessionValue('node_id') . "
    ORDER by
        tar.position asc"
    ,__FILE__,__LINE__,$GLOBALS['plugin']->getParam("debug_sql"));
$data = XT::getQueryData($result);

XT::assign("PRODUCTS", $data);

$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("nodes") . "
    WHERE
        node_id = " . $GLOBALS['plugin']->getSessionValue('node_id') . "
    AND
        lang='" . $GLOBALS['lang']->getLang() . "'
    ",__FILE__,__LINE__,0);
// Empty data array and fill data into it
$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}
XT::assign("NODE", $data[0]);

// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);
?>