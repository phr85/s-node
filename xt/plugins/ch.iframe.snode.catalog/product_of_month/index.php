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
        main.art_nr,
        images.image_id as image,
        files.type as image_type
    FROM
        " . $GLOBALS['plugin']->getTable("articles_details") . " as ad
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("articles") . " as main ON(main.id = ad.id)
    LEFT JOIN 
        " . $GLOBALS['plugin']->getTable("images") . "  as images ON(images.article_id = main.id AND images.is_main_image=1)
    LEFT JOIN 
        " . $GLOBALS['plugin']->getTable("files") . "  as files ON(files.id = images.image_id)
        
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
                " . $GLOBALS['plugin']->getTable("articles_details") . " as ad
            LEFT JOIN
                " . XT::gettable('tree2articles') . " as node on(ad.id = node.article_id)
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