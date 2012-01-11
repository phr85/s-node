<?php

if(XT::getPermission("editArticle")){

    // Enable page navigator
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());
    // set And get session values
    if(!XT::getValue('id')){
        $GLOBALS['plugin']->setValue('id', $GLOBALS['plugin']->getSessionValue('articleID'));
    }else{
        $GLOBALS['plugin']->setSessionValue('articleID',XT::getValue('id'));
    }

    $result = XT::query("
        SELECT
            a.id,
            a.unit,
            a.pkg_unit,
            a.quantity,
            a.art_nr,
            a.active,
            d.title,
            d.subtitle,
            d.lang,
            d.lead,
            d.description,
            d.active as lang_active,
            a.stock,
            a.min_stock
        FROM
            " . XT::getTable('articles') . " as a
        LEFT JOIN
            " . XT::getTable('articles_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        WHERE a.id = " . XT::getValue('id') ,__FILE__,__LINE__,0);

    $data = XT::getQueryData($result);
    XT::assign("DATA", $data[0]);


    $result = XT::query("
        SELECT
            article_id,
            field_id,
            value,
            position,
            label
        FROM
            " . XT::getTable('fields_values') . "
        WHERE
            article_id = " . XT::getValue('id') . "
        AND
            lang = '" . $GLOBALS['plugin']->getActiveLang() . "'"
    ,__FILE__,__LINE__);

    while($row = $result->FetchRow()){
        $fieldvalues[$row['field_id']][$row['position']] = $row['value'];
        $fieldlabels[$row['field_id']][$row['position']] = $row['label'];
    }


    // additional field
    $result = XT::query("
        SELECT
            rel.article_id,
            n.description,
            n.title as label,
            rel.field_id,
            n.type,
            n.value as typevalue

        FROM
            " . XT::getTable('fields_rel') . " as rel
        LEFT JOIN
            " . XT::getTable('fields') . " as n
        ON
            (n.id = rel.field_id AND rel.lang = n.lang)
        WHERE
            rel.article_id = " . XT::getValue('id') . "
        AND
            rel.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        ORDER BY

            n.position ASC"
    ,__FILE__,__LINE__);

    $articlefields = XT::getQueryData($result);

    $in = '';
    foreach ($articlefields as $key => $val){
        $in .= ',' . $val['field_id'];
        $articlefields[$key]['value'] = $fieldvalues[$val['field_id']][1];
        unset($newarray);
        switch ($val['type']) {

            case 1:
            // bool
            // create array for bool
            $articlefields[$key]['preptypevalue'] = explode('[|]',$val['typevalue']);
            $articlefields[$key]['value'] = $fieldvalues[$val['field_id']][1];
            break;
            case 2:
            //number
            $tmp = explode('[|]',$val['typevalue']);
            $tmpmin = explode(':', $tmp[0]);
            $tmpmax = explode(':', $tmp[1]);
            $articlefields[$key]['preptypevalue']['min'] = $tmpmin[1];
            $articlefields[$key]['preptypevalue']['max'] = $tmpmax[1];
            // format this value
            $articlefields[$key]['value'] = $fieldvalues[$val['field_id']][1] * 1;
            break;
            case 5:
            // number range
            $range = explode(';',$val['typevalue']);
            //left number
            $tmp = explode('[|]',$range[0]);
            $tmpmin = explode(':', $tmp[0]);
            $tmpmax = explode(':', $tmp[1]);
            $articlefields[$key]['preptypevalue']['l']['min'] = $tmpmin[1];
            $articlefields[$key]['preptypevalue']['l']['max'] = $tmpmax[1];
            //right number
            $tmp = explode('[|]',$range[1]);

            $tmpmin = explode(':', $tmp[0]);
            $tmpmax = explode(':', $tmp[1]);
            $articlefields[$key]['preptypevalue']['r']['min'] = $tmpmin[1];
            $articlefields[$key]['preptypevalue']['r']['max'] = $tmpmax[1];
            // format this value

            $articlefields[$key]['decimal1'] =$fieldvalues[$val['field_id']][1] * 1;;
            $articlefields[$key]['decimal2'] =$fieldvalues[$val['field_id']][2] * 1;;



            break;
            case 3:
            // single dropdown
            $values = explode('[;]',$val['typevalue']);
            $default = false;
            foreach ($values as $dkey => $value) {
                $line = explode('[|]',$value);
                if($line[1]==NULL){
                    $line[1] = $line[0];
                }
                if($line[0] != NULL){
                    if($line[2] != NULL && $default == false){
                        $newarray[$dkey]['value'] = trim($line[0]);
                        $newarray[$dkey]['label'] = trim($line[1]);
                        $newarray[$dkey]['default'] = 1;
                        $default = true;
                    }else{
                        $newarray[$dkey]['value'] = trim($line[0]);
                        $newarray[$dkey]['label'] = trim($line[1]);
                        $newarray[$dkey]['default'] = 0;

                    }
                }
            }
            $articlefields[$key]['preptypevalue'] = $newarray;
            $articlefields[$key]['value'] = $fieldvalues[$val['field_id']][1];
            break;

            case 9:
            // single dropdown
            $values = explode('[;]',$val['typevalue']);
            $default = false;
            foreach ($values as $dkey => $value) {
                $line = explode('[|]',$value);
                if($line[1]==NULL){
                    $line[1] = $line[0];
                }
                if($line[0] != NULL){
                    if($line[2] != NULL && $default == false){
                        $newarray[$dkey]['value'] = trim($line[0]);
                        $newarray[$dkey]['label'] = trim($line[1]);
                        $newarray[$dkey]['default'] = 1;
                        $default = true;
                    }else{
                        $newarray[$dkey]['value'] = trim($line[0]);
                        $newarray[$dkey]['label'] = trim($line[1]);
                        $newarray[$dkey]['default'] = 0;

                    }
                }
            }
            $articlefields[$key]['preptypevalue'] = $newarray;
            $articlefields[$key]['value'] = $fieldvalues[$val['field_id']][1];
            break;
            case 4:
            // multi dropdown

            $selected = array();
            $selected = explode(';',$val['value']);

            $values = explode('[;]',$val['typevalue']);
            foreach ($values as $dkey => $value) {
                $line = explode('[|]',$value);
                if($line[1]==NULL){
                    $line[1] = $line[0];
                }
                // if no value given, use defaults from the element

                if($fieldvalues[$val['field_id']][1] == ""){
                    if($line[0] != NULL){
                        if($line[2] == 'default'){
                            $newarray[$dkey]['value'] = trim($line[0]);
                            $newarray[$dkey]['label'] = trim($line[1]);
                            $newarray[$dkey]['default'] = 1;
                        }else{

                            $newarray[$dkey]['value'] = trim($line[0]);
                            $newarray[$dkey]['label'] = trim($line[1]);
                            $newarray[$dkey]['default'] = 0;
                        }
                    }
                }else {

                    if(in_array(trim($line[0]),$fieldvalues[$val['field_id']])){
                        $newarray[$dkey]['value'] = trim($line[0]);
                        $newarray[$dkey]['label'] = trim($line[1]);
                        $newarray[$dkey]['default'] = 1;
                    }else{
                        $newarray[$dkey]['value'] = trim($line[0]);
                        $newarray[$dkey]['label'] = trim($line[1]);
                        $newarray[$dkey]['default'] = 0;
                    }
                }
            }
            $articlefields[$key]['preptypevalue'] = $newarray;

            case 10:
            // multi dropdown

            $selected = array();
            $selected = explode(';',$val['value']);

            $values = explode('[;]',$val['typevalue']);
            foreach ($values as $dkey => $value) {
                $line = explode('[|]',$value);
                if($line[1]==NULL){
                    $line[1] = $line[0];
                }
                // if no value given, use defaults from the element

                if($fieldvalues[$val['field_id']][1] == ""){
                    if($line[0] != NULL){
                        if($line[2] == 'default'){
                            $newarray[$dkey]['value'] = trim($line[0]);
                            $newarray[$dkey]['label'] = trim($line[1]);
                            $newarray[$dkey]['default'] = 1;
                        }else{

                            $newarray[$dkey]['value'] = trim($line[0]);
                            $newarray[$dkey]['label'] = trim($line[1]);
                            $newarray[$dkey]['default'] = 0;
                        }
                    }
                }else {

                    if(in_array(trim($line[0]),$fieldvalues[$val['field_id']])){
                        $newarray[$dkey]['value'] = trim($line[0]);
                        $newarray[$dkey]['label'] = trim($line[1]);
                        $newarray[$dkey]['default'] = 1;
                    }else{
                        $newarray[$dkey]['value'] = trim($line[0]);
                        $newarray[$dkey]['label'] = trim($line[1]);
                        $newarray[$dkey]['default'] = 0;
                    }
                }
            }
            $articlefields[$key]['preptypevalue'] = $newarray;

            break;
            case 6:
                // select the dropdown and pickers
                $result = XT::query("SELECT cp.template
                    FROM
                        " . XT::getDatabasePrefix() . "pickers cp
                    WHERE
                        cp.content_type = '" . $val['typevalue'] . "'"
                    ,__FILE__,__LINE__);

                while ($row = $result->fetchRow()) {
                    $articlefields[$key]['picker'] = $row['template'];
                }
                $newarray = array(1 => "");
                if(is_array($fieldvalues[$val['field_id']])){
                    foreach ($fieldvalues[$val['field_id']] as $dkey => $fvalue){
                        $newarray[$dkey]['content_id'] = $fvalue;
                        $newarray[$dkey]['title'] = $fieldlabels[$val['field_id']][$dkey] ;

                        if(is_numeric($fvalue)){
                            $result = XT::query("SELECT title,image FROM " . XT::getDatabasePrefix() . "search_infos_global_" .  $GLOBALS['plugin']->getActiveLang() . " WHERE content_type = " . $val['typevalue'] . " AND content_id=" . $fvalue,__FILE__,__LINE__);
                            $dets = $result->fetchRow();
                            $newarray[$dkey]['image'] = $dets['image'];

                        }
                    }
                }
                $articlefields[$key]['relations'] = $newarray;
            break;
            case 7:
                // select the dropdown and pickers
                $result = XT::query("SELECT cp.template
                    FROM
                        " . XT::getDatabasePrefix() . "pickers cp
                    WHERE
                        cp.content_type = '" . $val['typevalue'] . "'"
                    ,__FILE__,__LINE__);

                while ($row = $result->fetchRow()) {
                    $articlefields[$key]['picker'] = $row['template'];
                }
                $newarray = array();
                if(is_array($fieldvalues[$val['field_id']])){
                    foreach ($fieldvalues[$val['field_id']] as $dkey => $fvalue){
                        $newarray[$dkey]['content_id'] = $fvalue;
                        $newarray[$dkey]['title'] = $fieldlabels[$val['field_id']][$dkey] ;
                        if(is_numeric($fvalue)){
                            $result = XT::query("SELECT title,image FROM " . XT::getDatabasePrefix() . "search_infos_global_" .  $GLOBALS['plugin']->getActiveLang() . " WHERE content_type = " . $val['typevalue'] . " AND content_id=" . $fvalue,__FILE__,__LINE__);
                            $dets = $result->fetchRow();
                            $newarray[$dkey]['image'] = $dets['image'];

                        }
                    }
                }
                $articlefields[$key]['relations'] = $newarray;
            break;
            case 11:
                $dtypevalues = explode("[;]", $val['typevalue']);
                $dvalues = explode("[;]", $fieldvalues[$val['field_id']][1]);
                foreach($dtypevalues as $dtypekey => $dtypevalue) {
                    $articlefields[$key]['preptypevalue'][$dtypekey]['value'] = $dvalues[$dtypekey];
                    $articlefields[$key]['preptypevalue'][$dtypekey]['label'] = $dtypevalue;
                }
                break;
        }


    }
    XT::assign("ARTICLEFIELDS",$articlefields);
    //XT::printArray($articlefields);

    //fields
    $result = XT::query("
        SELECT
            f.id,
            f.title
        FROM
            " . XT::getTable('fields') . " as f
        WHERE
            f.id not in (0 " . $in . ") AND
            f.lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND
            f.title != ''
        ORDER BY
            f.position ASC,
            f.title ASC"
    ,__FILE__,__LINE__,0);

    while($row = $result->FetchRow()){
        $fieldnames[$row['id']] = $row['title'];
    }

    XT::assign("FIELDNAMES", $fieldnames);


    //Units
    $result = XT::query("
        SELECT
            u.id,
            u.standard,
            ud.short
        FROM
            " . XT::getTable('units') . " as u
        LEFT JOIN
            " . XT::getTable('units_det') . " as ud
        ON
            (u.id = ud.id AND ud.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
        ORDER BY
            ud.short
        ",__FILE__,__LINE__);

    while($row = $result->FetchRow()){
        $units[$row['id']] = $row['standard'] . " / " . $row['short'];
    }

    XT::assign("UNITS", $units);

    //Units
    $result = XT::query("
        SELECT
            u.id,
            u.standard,
            ud.short
        FROM
            " . XT::getTable('pkg_units') . " as u
        LEFT JOIN
            " . XT::getTable('pkg_units_det') . " as ud
        ON
            (u.id = ud.id AND ud.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
        ORDER BY
            ud.short
        ",__FILE__,__LINE__);

    while($row = $result->FetchRow()){
        $pkg_units[] = $row;
    }

    XT::assign("PKG_UNITS", $pkg_units);

    //Images
    XT::assign("IMAGE_PICKER_TPL", $GLOBALS['plugin']->getConfig("image_picker_tpl"));
    XT::assign("IMAGE_PICKER_BASE_ID", $GLOBALS['plugin']->getConfig("image_picker_base_id"));
    XT::assign("IMAGE_CATEGORY_PICKER_TPL", $GLOBALS['plugin']->getConfig("image_category_picker_tpl"));


    $result = XT::query("
        SELECT
            i.image_id as image,
            i.image_version as version,
            i.is_main_image as main,
            i.position
        FROM
            " . XT::getTable('images') . " as i
        WHERE
            i.article_id = " . XT::getValue('id') . "
        ORDER BY
            i.position ASC"
    ,__FILE__,__LINE__,0);
    XT::assign("IMAGES",XT::getQueryData($result));

    //VARIABLEN
if($display['variables'] == true){
    XT::assign("VARIABLES", XT::getQueryData(XT::query("SELECT * FROM " . XT::getTable('articles_vars') . " WHERE id=" .XT::getValue("id") . " AND lang='" . $GLOBALS['plugin']->getActiveLang() . "'
    ORDER by position ASC",__FILE__,__LINE__),'position'));
    XT::addImageButton('get from default lang','getVariablesFromDefaultLanguage','getVariablesFromDefaultLanguage',"document_into.png","0","slave1");
    XT::assign("VARIABLE_ARTICLES_BUTTONS", $GLOBALS['plugin']->getButtons('getVariablesFromDefaultLanguage'));


}
    // Related articles

    if($display['relations'] == true){
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
                            " . XT::getTable('articles_details') . " as ad
                        LEFT JOIN
                            " . XT::getTable('articles_relations') . " as a2t on (a2t.article_id = ad.id)
                        LEFT JOIN
                            " . XT::getTable('images') . "  as i on (i.article_id = ad.id AND i.is_main_image = 1)
                        LEFT JOIN
                            " . XT::getTable('articles') . " as a on (a.id = ad.id)
                        WHERE
                            a2t.main_article_id=" .XT::getValue("id") . "
                         AND
                            ad.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
                        ORDER BY
                            a2t.position ASC",__FILE__, __LINE__,0);

        XT::assign("RELATED_ARTICLES", XT::getQueryData($result));
        $conf['related'] = true;
    }

    // Set articles
    if($display['sets'] == 1){
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
                            " . XT::getTable('articles_details') . " as ad
                        LEFT JOIN
                            " . XT::getTable('articles_set') . " as a2t on (a2t.article_id = ad.id)
                        LEFT JOIN
                            " . XT::getTable('images') . "  as i on (i.article_id = ad.id AND i.is_main_image = 1)
                        LEFT JOIN
                            " . XT::getTable('articles') . " as a on (a.id = ad.id)
                        WHERE
                            a2t.main_article_id=" .XT::getValue("id") . "
                         AND
                            ad.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
                        ORDER BY
                            a2t.position ASC",__FILE__, __LINE__,0);

        XT::assign("SET_ARTICLES", XT::getQueryData($result));
        $conf['sets'] = true;
    }


    XT::assign("CONF", $conf);

    $result = XT::query("
        SELECT
            id,
            name
        FROM
            " . XT::getTable("fieldgroups") . "
        WHERE
            lang='" . $GLOBALS['plugin']->getActiveLang() . "'
    ",__FILE__,__LINE__);

    $groups = array();

    while ($row = $result->fetchRow()) {
        $groups[$row['id']] = $row['name'];
    }
    XT::assign("GROUPS", $groups);

    // Fetch content
    $content = XT::build("edit_articles.tpl");
}else{
    XT::log("No Permission \"edit\" (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
}

?>