<?php

if(XT::getPermission("editArticle")){

    // Enable page navigator
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());
    // set And get session values
    if(!$GLOBALS['plugin']->getValue('id')){
        $GLOBALS['plugin']->setValue('id', $GLOBALS['plugin']->getSessionValue('articleID'));
    }else{
        $GLOBALS['plugin']->setSessionValue('articleID',$GLOBALS['plugin']->getValue('id'));
    }

    $result = XT::query("
        SELECT
            a.id,
            a.unit,
            a.quantity,
            a.art_nr,
            a.active,
            d.title,
            d.lang,
            d.lead,
            d.package,
            d.active as lang_active
        FROM
            " . $GLOBALS['plugin']->getTable('articles') . " as a
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable('articles_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        WHERE a.id = " . $GLOBALS['plugin']->getValue('id') ,__FILE__,__LINE__,0);

    $data = XT::getQueryData($result);
    XT::assign("DATA", $data[0]);
    // additional field
    $result = XT::query("
        SELECT
            f.article_id,
            n.description,
            n.fieldname as label,
            f.fieldname_id as field_id,
            f.value
        FROM
            " . $GLOBALS['plugin']->getTable('fields') . " as f
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable('fieldnames') . " as n
        ON
            (n.id = f.fieldname_id AND f.lang = n.lang)
        WHERE
            f.article_id = " . $GLOBALS['plugin']->getValue('id') . "
        AND
            f.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        ORDER BY
            n.position ASC,
            n.fieldname ASC"
        ,__FILE__,__LINE__,0);

    $articlefields = XT::getQueryData($result);
    XT::assign("ARTICLEFIELDS",$articlefields);
    $in = '';
    foreach ($articlefields as $val){
        $in .= ',' . $val['field_id'];
    }

    //Fieldnames
    $result = XT::query("
        SELECT
            f.id,
            f.fieldname
        FROM
            " . $GLOBALS['plugin']->getTable('fieldnames') . " as f
        WHERE
            f.id not in (0 " . $in . ") AND
            f.lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND
            f.fieldname != ''
        ORDER BY
            f.position ASC,
            f.fieldname ASC"
        ,__FILE__,__LINE__,0);

    while($row = $result->FetchRow()){
        $fieldnames[$row['id']] = $row['fieldname'];
    }

    XT::assign("FIELDNAMES", $fieldnames);


    //Images
    XT::assign("IMAGE_PICKER_TPL", $GLOBALS['plugin']->getConfig("image_picker_tpl"));
    XT::assign("IMAGE_PICKER_BASE_ID", $GLOBALS['plugin']->getConfig("image_picker_base_id"));


    $result = XT::query("
        SELECT
            i.image_id as image,
            i.image_version as version,
            i.is_main_image as main,
            i.position
        FROM
            " . $GLOBALS['plugin']->getTable('images') . " as i
        WHERE
            i.article_id = " . $GLOBALS['plugin']->getValue('id') . "
        ORDER BY
            i.position ASC"
        ,__FILE__,__LINE__,0);
    XT::assign("IMAGES",XT::getQueryData($result));


    // Related articles
    if($GLOBALS['plugin']->getConfig('use_related') == true){
        XT::addImageButton('Add relation','addArticleRelation','articles_add_relation',"","0","slave1");
        XT::assign("RELATED_ARTICLES_BUTTONS", $GLOBALS['plugin']->getButtons('articles_add_relation'));

        $result = XT::query("SELECT
                            ad.id,
                            ad.title,
                            ad.lead,
                            a.art_nr,
                            ad.active as lang_active,
                            ad.lang,
                            a2t.position,
                            a2t.article_id,
                            i.image_id

                        FROM
                            " . $GLOBALS['plugin']->getTable('articles_details') . " as ad
                        LEFT JOIN
                            " . $GLOBALS['plugin']->getTable('articles_relations') . " as a2t on (a2t.article_id = ad.id)
                        LEFT JOIN
                            " . $GLOBALS['plugin']->getTable('images') . "  as i on (i.article_id = ad.id AND i.is_main_image = 1)
                        LEFT JOIN
                            " . $GLOBALS['plugin']->getTable('articles') . " as a on (a.id = ad.id)
                        WHERE
                            a2t.main_article_id=" .$GLOBALS['plugin']->getValue("id") . "
                         AND
                            ad.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
                        ORDER BY
                            a2t.position ASC",__FILE__, __LINE__,0);

        XT::assign("RELATED_ARTICLES", XT::getQueryData($result));
        $conf['related'] = true;
    }

    // Set articles
    if($GLOBALS['plugin']->getConfig('use_sets') == true){
        XT::addImageButton('Add set','addArticleSet','articles_add_set',"","0","slave1");
        XT::assign("SET_ARTICLES_BUTTONS", $GLOBALS['plugin']->getButtons('articles_add_set'));

        $result = XT::query("SELECT
                            ad.id,
                            ad.title,
                            ad.lead,
                            a.art_nr,
                            ad.active as lang_active,
                            ad.lang,
                            a2t.position,
                            a2t.article_id,
                            i.image_id

                        FROM
                            " . $GLOBALS['plugin']->getTable('articles_details') . " as ad
                        LEFT JOIN
                            " . $GLOBALS['plugin']->getTable('articles_set') . " as a2t on (a2t.article_id = ad.id)
                        LEFT JOIN
                            " . $GLOBALS['plugin']->getTable('images') . "  as i on (i.article_id = ad.id AND i.is_main_image = 1)
                        LEFT JOIN
                            " . $GLOBALS['plugin']->getTable('articles') . " as a on (a.id = ad.id)
                        WHERE
                            a2t.main_article_id=" .$GLOBALS['plugin']->getValue("id") . "
                         AND
                            ad.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
                        ORDER BY
                            a2t.position ASC",__FILE__, __LINE__,0);

        XT::assign("SET_ARTICLES", XT::getQueryData($result));
        $conf['sets'] = true;
    }

    XT::assign("CONF", $conf);

    // Fetch content
    $content = XT::build("edit_articles.tpl");
}else{
    XT::log("No Permission \"edit\" (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
}

?>
