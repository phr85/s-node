<?PHP
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
        unit.short as unit,
        main.art_nr,
        p.price
    FROM
        " . $GLOBALS['plugin']->getTable("catalog_articles_details") . " as ad
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("catalog_images") . " as img ON (img.article_id = ad.id AND img.is_main_image = 1)
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("shop_articles") . " as p ON(p.article_id = ad.id)
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("catalog_articles") . " as main ON(main.id = ad.id)
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("fields") . " as f ON(f.article_id = ad.id AND f.lang='" . $GLOBALS['lang']->getLang() . "' AND f.fieldname_id='" . $GLOBALS['plugin']->getParam("field_id") . "')
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("units_det") . " as unit ON(main.unit = unit.id AND unit.lang='" . $GLOBALS['lang']->getLang() . "')
    WHERE
        ad.lang='" . $GLOBALS['lang']->getLang() . "'
    AND
        p.buyable = 1
    AND
        ad.active=1
    AND
        main.id=" . $GLOBALS['plugin']->getParam('product_id')
    ,__FILE__,__LINE__,$GLOBALS['plugin']->getParam("debug_sql"));
$data = XT::getQueryData($result);

if($GLOBALS['plugin']->getValue("firstitem") != 1){
   $GLOBALS['plugin']->setValue("firstitem",1) ;
   XT::assign("FIRSTITEM",1);
}else{
   XT::assign("FIRSTITEM",0);
}

XT::assign('FORMNAME', 'directbuy' . $data[0]['id']);
XT::assign("PRODUCT", $data[0]);

// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);
?>