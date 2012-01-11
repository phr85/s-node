<?php
// set And get session values
if(!$GLOBALS['plugin']->getValue('article_id')){
    $GLOBALS['plugin']->setValue('article_id', $GLOBALS['plugin']->getSessionValue('article_id'));
}else{
    $GLOBALS['plugin']->setSessionValue('article_id',$GLOBALS['plugin']->getValue('article_id'));
}

if ($GLOBALS['plugin']->getSessionValue('article_id') == ''){
	$GLOBALS['plugin']->setSessionValue('article_id', 0);
}

$result = XT::query("
    SELECT
        ad.id,
        ad.title,
        ad.subtitle,
        ad.lead,
        ad.description,
        ad.active,
        main.quantity,
        main.art_nr
    FROM
        " . $GLOBALS['plugin']->getTable("articles_details") . " as ad
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("articles") . " as main ON(main.id = ad.id)
    WHERE
        ad.lang='" . $GLOBALS['lang']->getLang() . "'
    AND
        ad.active=1
    AND
        main.id=" . $GLOBALS['plugin']->getSessionValue('article_id')
    ,__FILE__,__LINE__,$GLOBALS['plugin']->getParam("debug_sql"));

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