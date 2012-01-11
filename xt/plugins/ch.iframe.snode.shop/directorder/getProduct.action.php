<?php

$_SESSION['shop']['direct'] = array(
    0 => array(),
    1 => array(),
    2 => array(),
    3 => array(),
    4 => array(),
    5 => array(),
);

$quantities = $GLOBALS['plugin']->getValue('quantity');
$errors = array();
$count = 0;
foreach($GLOBALS['plugin']->getValue('artnr') as $key => $value){
    if($value != '' && $quantities[$key] != "0" && (($GLOBALS['plugin']->getValue("remove") != $key && $remove) || !$remove)){
        $result = XT::query("
            SELECT
                a.price,
                a.article_id,
                c.art_nr,
                b.title,
                img.image_id,
                img.image_version
            FROM
                " . $GLOBALS['plugin']->getTable('price') . " as a,
                " . $GLOBALS['plugin']->getTable('catalog_articles') . " as c,
                " . $GLOBALS['plugin']->getTable('catalog_articles_details') . " as b LEFT JOIN
                " . $GLOBALS['plugin']->getTable('catalog_images') . " as img ON (img.article_id = b.id AND img.is_main_image = 1)
            WHERE
                c.art_nr = '" . $value . "'
                AND a.article_id = c.id
                AND c.id = b.id
                AND b.active = 1
                AND b.lang = '" . $GLOBALS['lang']->getLang() . "'
        ",__FILE__,__LINE__);

        $data = array();
        while($row = $result->FetchRow()){
            $data[] = $row;
        }

        if(count($data) > 0){

            $_SESSION['shop']['direct'][$count]['id'] = $data[0]['article_id'];
            $_SESSION['shop']['direct'][$count]['art_nr'] = $data[0]['art_nr'];
            $_SESSION['shop']['direct'][$count]['title'] = strip_tags($data[0]['title']);
            $_SESSION['shop']['direct'][$count]['price'] = $data[0]['price'];
            $_SESSION['shop']['direct'][$count]['image_id'] = $data[0]['image_id'];
            $_SESSION['shop']['direct'][$count]['image_version'] = $data[0]['image_version'];
            if($quantities[$key] <= 0){
                $_SESSION['shop']['direct'][$count]['quantity'] = 1;
            } else {
                $_SESSION['shop']['direct'][$count]['quantity'] = $quantities[$key];
            }
            $count++;

        } else {

            $errors[] = XT::translate_replace('The product with article no. <b>%1</b> does not exist!',array($value));

        }
    }
}

if($count > 2){
    for($i = 0; $i <= 4; $i++){
        $_SESSION['shop']['direct'][] = array();
    }
}

XT::assign("ERRORS", $errors);
?>