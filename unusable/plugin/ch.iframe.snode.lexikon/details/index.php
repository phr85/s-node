<?php
// set And get session values
if(!$GLOBALS['plugin']->getValue('article_id')){
    $GLOBALS['plugin']->setValue('article_id', $GLOBALS['plugin']->getSessionValue('article_id'));
}else{
    $GLOBALS['plugin']->setSessionValue('article_id',$GLOBALS['plugin']->getValue('article_id'));
}
$result = XT::query("
    SELECT
        ad.id,
        img.image_id,
        img.image_version,
        ad.title,
        ad.lead,
        ad.active,
        f.value as field_text

    FROM
        " . $GLOBALS['plugin']->getTable("articles_details") . " as ad
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("images") . " as img ON (img.article_id = ad.id AND img.is_main_image = 1)
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("fields") . " as f ON(f.article_id = ad.id AND f.lang='" . $GLOBALS['lang']->getLang() . "' AND f.fieldname_id=" . $GLOBALS['plugin']->getParam("field_id") . ")
    WHERE
        ad.lang='" . $GLOBALS['lang']->getLang() . "'
    AND
        ad.active=1
    AND
        ad.id=" . $GLOBALS['plugin']->getSessionValue('article_id')
    ,__FILE__,__LINE__,$GLOBALS['plugin']->getParam("debug_sql"));
$data = XT::getQueryData($result);
XT::assign("DATA", $data[0]);
$result = XT::query("
    SELECT
        f.value,
        fn.fieldname
    FROM
        " . $GLOBALS['plugin']->getTable("fields") . " as f
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("fieldnames") . " as fn ON(f.fieldname_id = fn.id  AND fn.lang='" . $GLOBALS['lang']->getLang() . "')
    WHERE
        f.article_id=" . $GLOBALS['plugin']->getSessionValue('article_id') . "
    AND
        f.fieldname_id != " . $GLOBALS['plugin']->getParam("field_id") . "
        AND f.lang='" . $GLOBALS['lang']->getLang() . "'
  ORDER BY
        fn.position ASC,
        fn.fieldname ASC"
    ,__FILE__,__LINE__,$GLOBALS['plugin']->getParam("debug_sql"));

$data = XT::getQueryData($result);
XT::assign("FIELDS", $data);


// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);
?>