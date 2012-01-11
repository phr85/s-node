<?php


    // Geschenke

    // get reached credits
    $gift = $GLOBALS['plugin']->getConfig("gift");
    foreach ($gift as $g => $val){
        if($val < $price){
            $reached_credits = $g;
        }
    }

    $available_credits = $reached_credits;


    $count_credits = 0;
    if(array_key_exists('GIFT',$_SESSION) && array_key_exists('selected',$_SESSION['GIFT']) && is_array($_SESSION['GIFT']['selected'])){
        foreach ($_SESSION['GIFT']['selected'] as $key => $value){
            $count_credits += $value['points'];
            if($count_credits > $available_credits){
                unset($_SESSION['GIFT']['selected'][$key]);
            }
        }
    }

    $available_credits = $reached_credits - $count_credits;

    if($available_credits < 1){
        XT::assign("HIDEADD", 1);
    }else{
        XT::assign("HIDEADD", 0);
    }

    XT::assign("SELECTEDGIFTS", $_SESSION['GIFT']['selected']);

    if($reached_credits > 0){

        XT::assign("DISPLAYGIFT", 1);

        // get available presents
        $result = XT::query("
            SELECT
                ad.id,
                img.image_id,
                img.image_version,
                ad.title,
                ad.lead,
                img.image_id,
                img.image_version,
                ad.title,
                ad.active,
                unit.short as unit,
                main.quantity,
                main.art_nr

            FROM
                " . $GLOBALS['plugin']->getTable("catalog_articles_details") . " as ad
            LEFT JOIN
                " . $GLOBALS['plugin']->getTable("catalog_images") . " as img ON (img.article_id = ad.id AND img.is_main_image = 1)
            LEFT JOIN
                " . $GLOBALS['plugin']->getTable("price") . " as p ON (p.article_id = ad.id)
            LEFT JOIN
            " . $GLOBALS['plugin']->getTable("catalog_articles") . " as main ON(main.id = ad.id)
            LEFT JOIN
                " . $GLOBALS['plugin']->getTable("units_det") . " as unit ON (main.unit = unit.id AND unit.lang='" . $GLOBALS['lang']->getLang() . "')
            WHERE
                ad.lang='" . $GLOBALS['lang']->getLang() . "'
            AND
                ad.active=1
            AND
                p.gift >=1
            AND
                p.gift<=" . $available_credits ,__FILE__,__LINE__,0);

        XT::assign("PRESENT", XT::getQueryData($result));


    }


?>