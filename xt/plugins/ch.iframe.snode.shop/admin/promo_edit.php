<?php

if(XT::getPermission("manage_promo")){
    // set And get session values
    if(!$GLOBALS['plugin']->getValue('id')){
        $GLOBALS['plugin']->setValue('id', $GLOBALS['plugin']->getSessionValue('id'));
    }else{
        $GLOBALS['plugin']->setSessionValue('id',$GLOBALS['plugin']->getValue('id'));
    }

    // Enable page navigator
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    $result = XT::query("
        SELECT
            d.id,
            d.kummulierbar,
            d.give_discount_at,
            dd.description,
            dd.name
        FROM
            " . $GLOBALS['plugin']->getTable('promo') . " as d
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable('promo_details') . " as dd ON (d.id = dd.id AND dd.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        WHERE d.id = " . $GLOBALS['plugin']->getValue('id') ,__FILE__,__LINE__);

    XT::assign("BASECURENCY", $GLOBALS['plugin']->getConfig('base_currency'));

    $data = XT::getQueryData($result);
    XT::assign("DATA", $data[0]);

    XT::addImageButton('[S]ave','savepromo','promo_edit','disk_blue.png','0','slave1','s');
    XT::addImageButton('Save and [E]xit','exitAndSavepromo','promo_edit','save_close.png','0','slave1','e');
    XT::addImageButton('E[x]it','exitpromo','promo_edit','exit.png','0','slave1','x');

    XT::assign("EDIT_BUTTONS", $GLOBALS['plugin']->getButtons('promo_edit'));

    XT::addImageButton('Add articles','addpromoArticles','promo_edit_add_articles','add.png','0','slave1','a');
    XT::assign("EDIT_ADD_ARTICLES_BUTTONS", $GLOBALS['plugin']->getButtons('promo_edit_add_articles'));

    XT::addImageButton('Add GIFTs','addpromogifts','promo_edit_add_gifts','add.png','0','slave1','a');
    XT::assign("EDIT_ADD_GIFTS_BUTTONS", $GLOBALS['plugin']->getButtons('promo_edit_add_gifts'));


    $result = XT::query("SELECT
                        ad.id,
                        ad.title,
                        ad.lead,
                        a.art_nr,
                        ad.active as lang_active,
                        ad.lang,
                        a2t.discount_id,
                        a2t.position,
                        a2t.article_id,
                        i.image_id

                    FROM
                        " . $GLOBALS['plugin']->getTable('catalog_articles_details') . " as ad
                    LEFT JOIN
                        " . $GLOBALS['plugin']->getTable('promo_articles') . " as a2t on (a2t.article_id = ad.id)
                    LEFT JOIN
                        " . $GLOBALS['plugin']->getTable('catalog_images') . "  as i on (i.article_id = ad.id AND i.is_main_image = 1)
                    LEFT JOIN
                        " . $GLOBALS['plugin']->getTable('catalog_articles') . " as a on (a.id = ad.id)
                    WHERE
                        a2t.discount_id=" .$GLOBALS['plugin']->getValue("id") . "
                     AND
                        ad.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
                    ORDER BY
                        a2t.position ASC",__FILE__, __LINE__,0);

    XT::assign("ARTICLES", XT::getQueryData($result));



    $result = XT::query("SELECT
                        ad.id,
                        ad.title,
                        ad.lead,
                        a.art_nr,
                        ad.active as lang_active,
                        ad.lang,
                        a2t.discount_id,
                        a2t.position,
                        a2t.article_id,
                        i.image_id

                    FROM
                        " . $GLOBALS['plugin']->getTable('catalog_articles_details') . " as ad
                    LEFT JOIN
                        " . $GLOBALS['plugin']->getTable('promo_gifts') . " as a2t on (a2t.article_id = ad.id)
                    LEFT JOIN
                        " . $GLOBALS['plugin']->getTable('catalog_images') . "  as i on (i.article_id = ad.id AND i.is_main_image = 1)
                    LEFT JOIN
                        " . $GLOBALS['plugin']->getTable('catalog_articles') . " as a on (a.id = ad.id)
                    WHERE
                        a2t.discount_id=" .$GLOBALS['plugin']->getValue("id") . "
                     AND
                        ad.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
                    ORDER BY
                        a2t.position ASC",__FILE__, __LINE__,0);

    XT::assign("GIFTS", XT::getQueryData($result));



    // Fetch content
    $content = XT::build("promo_edit.tpl");
}else{
    XT::log("No Permission \"edit\" (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
}

?>
