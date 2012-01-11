<?php
$GLOBALS['plugin']->setAdminModule('ea');
$do_search = 0;
// check ob datensatz in sprache existiert
$cnt = XT::getqueryData(XT::query("select count(*) as cnt FROM " . $GLOBALS['plugin']->getTable('articles_details') . "
          WHERE
              id=" . $GLOBALS['plugin']->getValue('id') . "
            AND
              lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
          ",__FILE__,__LINE__,0));
  
// leeren datensatz einfügen
if($cnt[0]['cnt'] == 0){
	
// article Details
XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('articles_details') . "
          SET
              id=" . $GLOBALS['plugin']->getValue('id') . ",
              lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
          ",__FILE__,__LINE__,0);
}

// update data
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('articles') . "
          SET
              unit= '" . $GLOBALS['plugin']->getValue('unit') . "',
              pkg_unit= '" . $GLOBALS['plugin']->getValue('pkg_unit') . "',
              quantity= '" . $GLOBALS['plugin']->getValue('quantity') . "',
              art_nr= '" . $GLOBALS['plugin']->getValue('art_nr',1) . "',
              stock= '" . $GLOBALS['plugin']->getValue('stock',1) . "',
              min_stock= '" . $GLOBALS['plugin']->getValue('min_stock',1) . "',
              edate=" . TIME . "
          WHERE
              id=" . $GLOBALS['plugin']->getValue('id') . "
          ",__FILE__,__LINE__);
if(XT::queryRowsAffected() > 0){
    $do_search++;
}
// article Details
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('articles_details') . "
          SET
              title= '" . $GLOBALS['plugin']->getValue('title',1) . "',
              subtitle= '" . $GLOBALS['plugin']->getValue('subtitle',1) . "',
              lead= '" . $GLOBALS['plugin']->getValue('lead',1) . "',
              description= '" . $GLOBALS['plugin']->getValue('description',1) . "'
          WHERE
              id=" . $GLOBALS['plugin']->getValue('id') . "
          AND
              lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
          ",__FILE__,__LINE__,0);
if(XT::queryRowsAffected() > 0){
    $do_search++;
}

// Article Properties
if(is_array($GLOBALS['plugin']->getValue('field'))){
    foreach ($GLOBALS['plugin']->getValue('field') as $field_id => $value){

        switch ($value['type']) {
            case 0:
            // Text
            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_rel') . "
                  SET
                      display='" . $value['text'] . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id
            ,__FILE__,__LINE__,0);

            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_values') . "
                  SET
                      value='" .  $value['text'] . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id . "
                  AND
                      position = 1"
            ,__FILE__,__LINE__,0);

            $search_properties .= " " . $value['text'] . " ";

            break;

            case 8:
            // Text
            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_rel') . "
                  SET
                      display='" . $value['text'] . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id
            ,__FILE__,__LINE__,0);

            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_values') . "
                  SET
                      value='" .  $value['text'] . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id . "
                  AND
                      position = 1"
            ,__FILE__,__LINE__,0);

            $search_properties .= " " . $value['text'] . " ";

            break;
            case 1:
            // bool
            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_rel') . "
                  SET
                      display='" . $value[$value['boolean']] . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id
            ,__FILE__,__LINE__,0);

            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_values') . "
                  SET
                      value='" .  $value['boolean'] . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id . "
                  AND
                      position = 1"
            ,__FILE__,__LINE__,0);



            break;

            default:
            break;
            case 2:

            // number
            if(!is_numeric($value['decimal1'])){
                $value['decimal1'] = 0;
            }
            if(is_numeric($value['max']) && is_numeric($value['min'])){
                if($value['decimal1'] > $value['max']){
                    $value['decimal1'] = $value['max'];
                    XT::log("Number to big, reduced to maximal value from system",__FILE__,__LINE__,XT_ERROR);
                }
                if($value['decimal1'] < $value['min']){
                    $value['decimal1'] = $value['min'];
                    XT::log("Number to small, incrased to minimal value from system",__FILE__,__LINE__,XT_ERROR);
                }
            }
            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_rel') . "
                  SET
                      display='" . $value['decimal1'] . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id
            ,__FILE__,__LINE__,0);

            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_values') . "
                  SET
                      value='" .  $value['decimal1'] . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id . "
                  AND
                      position = 1"
            ,__FILE__,__LINE__);
            $search_properties .= " " . $value['decimal1']  . " ";
            break;

            case 5:
            // range of numbers
            if(!is_numeric($value['decimal1'])){
                $value['decimal1'] = 0;
            }
            if(is_numeric($value['l']['max']) && is_numeric($value['l']['min'])){
                if($value['decimal1'] > $value['l']['max']){
                    $value['decimal1'] = $value['l']['max'];
                }
                if($value['decimal1'] < $value['l']['min']){
                    $value['decimal1'] = $value['l']['min'];
                }
            }
            if(!is_numeric($value['decimal2'])){
                $value['decimal2'] = 0;
            }
            if(is_numeric($value['r']['max']) && is_numeric($value['r']['min'])){
                if($value['decimal2'] > $value['r']['max']){
                    $value['decimal2'] = $value['r']['max'];
                }
                if($value['decimal2'] < $value['r']['min']){
                    $value['decimal2'] = $value['r']['min'];
                }
            }

            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_rel') . "
                  SET
                      display='" . $value['decimal1'] . " - " . $value['decimal2'] . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id
            ,__FILE__,__LINE__,0);

            XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('fields_values') . "
               WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id ,__FILE__,__LINE__);


            XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('fields_values') . "
                  SET
                      value='" .  $value['decimal1'] . "',
                      label='min',
                      article_id=" . $GLOBALS['plugin']->getValue('id') . ",
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "',
                      field_id=" . $field_id . ",
                      position = 1"
            ,__FILE__,__LINE__,0);

            XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('fields_values') . "
                  SET
                      value='" .  $value['decimal2'] . "',
                      label='max',
                      article_id=" . $GLOBALS['plugin']->getValue('id') . ",
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "',
                      field_id=" . $field_id . ",
                      position = 2"
            ,__FILE__,__LINE__,0);
            $search_properties .= $value['decimal1']  . " - " . $value['decimal2'];
            break;

            case 3:
            // dropdown
            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_rel') . "
                  SET
                      display='" . $value['label'][$value['dropdown']] . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id
            ,__FILE__,__LINE__,0);

            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_values') . "
                  SET
                      value='" .  $value['dropdown'] . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id . "
                  AND
                      position = 1"
            ,__FILE__,__LINE__,0);


            $search_properties .= " " . $value['dropdown'] . " ";
            break;

            case 9:
            // dropdown
            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_rel') . "
                  SET
                      display='" . $value['label'][$value['dropdown']] . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id
            ,__FILE__,__LINE__,0);

            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_values') . "
                  SET
                      value='" .  $value['dropdown'] . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id . "
                  AND
                      position = 1"
            ,__FILE__,__LINE__,0);


            $search_properties .= " " . $value['dropdown'] . " ";
            break;


            case 4:
            unset($display);
            unset($displayarray);
            $multilabels = array();

            // multiselect dropdown
            if(is_array($value['multi'])){
                $multivalues = implode(';', $value['multi']);
                foreach ($value['multi'] as $selectedvalue) {
                    $multilabels[] = $value['label'][$selectedvalue];
                }
                $multilabels = implode(', ', $multilabels);
            }else{
                $multivalues = "0";
                $multilabels = "";
            }

            XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('fields_values') . "
               WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id ,__FILE__,__LINE__);
            $i = 1;

            if(is_array($value['multi'])){
            foreach ($value['multi'] as $multivals){
                XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('fields_values') . "
                  SET
                      value='" .  $multivals . "',
                      label='" . $value['label'][$multivals] . "',
                      article_id=" . $GLOBALS['plugin']->getValue('id') . ",
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "',
                      field_id=" . $field_id . ",
                      position = " . $i
                ,__FILE__,__LINE__,0);
                $i++;
                $displayarray[] = $value['label'][$multivals];
            }
            $display = implode(', ',$displayarray);
            }else {

                XT::log("Field " . $field_id . " No value selected, using default values",__FILE__,__LINE__,XT_WARNING);
            }
            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_rel') . "
                  SET
                      display='" . $display . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id
            ,__FILE__,__LINE__,0);

            $search_properties .= " " . $display . " ";
            break;

            case 10:
            unset($display);
            unset($displayarray);
            $multilabels = array();

            // multiselect dropdown
            if(is_array($value['multi'])){
                $multivalues = implode(';', $value['multi']);
                foreach ($value['multi'] as $selectedvalue) {
                    $multilabels[] = $value['label'][$selectedvalue];
                }
                $multilabels = implode(', ', $multilabels);
            }else{
                $multivalues = "0";
                $multilabels = "";
            }

            XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('fields_values') . "
               WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id ,__FILE__,__LINE__);
            $i = 1;

            if(is_array($value['multi'])){
            foreach ($value['multi'] as $multivals){
                XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('fields_values') . "
                  SET
                      value='" .  $multivals . "',
                      label='" . $value['label'][$multivals] . "',
                      article_id=" . $GLOBALS['plugin']->getValue('id') . ",
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "',
                      field_id=" . $field_id . ",
                      position = " . $i
                ,__FILE__,__LINE__,0);
                $i++;
                $displayarray[] = $value['label'][$multivals];
            }
            $display = implode(', ',$displayarray);
            }else {

                XT::log("Field " . $field_id . " No value selected, using default values",__FILE__,__LINE__,XT_WARNING);
            }
            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_rel') . "
                  SET
                      display='" . $display . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id
            ,__FILE__,__LINE__,0);

            $search_properties .= " " . $display . " ";
            break;

            case 6:
            unset($display);
            unset($displayarray);
                // delete old entries
                XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('fields_values') . "
                   WHERE
                          article_id=" . $GLOBALS['plugin']->getValue('id') . "
                      AND
                          lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                      AND
                          field_id=" . $field_id ,__FILE__,__LINE__);
            // insert entries
            $i = 1;
            if(is_array($value['elements'])){

                foreach ($value['elements'] as $item){
                    if(XT::getValue('field_' . $field_id . '_' . $item['count'] . '_target_content_id') != 'delete' && XT::getValue('field_' . $field_id . '_' . $item['count'] . '_target_content_id') != ''){
                         XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('fields_values') . "
                          SET
                              value='" .  XT::getValue('field_' . $field_id . '_' . $item['count'] . '_target_content_id') . "',
                              label='" .  XT::getValue('field_' . $field_id . '_' . $item['count'] . '_target_content_id_title') . "',
                              article_id=" . $GLOBALS['plugin']->getValue('id') . ",
                              lang='" . $GLOBALS['plugin']->getValue('save_lang') . "',
                              field_id=" . $field_id . ",
                              position = " . $i
                        ,__FILE__,__LINE__,0);
                        $displayarray[] = XT::getValue('field_' . $field_id . '_' . $item['count'] . '_target_content_id_title');
                        $i++;
                    }
                }
            }
            if(is_array($displayarray)){
                $display = implode(', ',$displayarray);
            }

            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_rel') . "
                  SET
                      display='" . $display . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id
            ,__FILE__,__LINE__);

            break;

            case 7:
            unset($display);
            unset($displayarray);
                // delete old entries
                XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('fields_values') . "
                   WHERE
                          article_id=" . $GLOBALS['plugin']->getValue('id') . "
                      AND
                          lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                      AND
                          field_id=" . $field_id ,__FILE__,__LINE__);
            // insert entries
            $i = 1;
            if(is_array($value['elements'])){

                foreach ($value['elements'] as $item){
                    if(XT::getValue('field_' . $field_id . '_' . $item['count'] . '_target_content_id') != 'delete' && XT::getValue('field_' . $field_id . '_' . $item['count'] . '_target_content_id') != ''){
                         XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('fields_values') . "
                          SET
                              value='" .  XT::getValue('field_' . $field_id . '_' . $item['count'] . '_target_content_id') . "',
                              label='" .  XT::getValue('field_' . $field_id . '_' . $item['count'] . '_target_content_id_title') . "',
                              article_id=" . $GLOBALS['plugin']->getValue('id') . ",
                              lang='" . $GLOBALS['plugin']->getValue('save_lang') . "',
                              field_id=" . $field_id . ",
                              position = " . $i
                        ,__FILE__,__LINE__,0);
                        $displayarray[] = XT::getValue('field_' . $field_id . '_' . $item['count'] . '_target_content_id_title');
                        $i++;
                    }
                }
            }
            if(is_array($displayarray)){
                $display = implode(', ',$displayarray);
            }

            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_rel') . "
                  SET
                      display='" . $display . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      field_id=" . $field_id
            ,__FILE__,__LINE__,0);

            break;
        
            case 11:
                // Text
                XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_rel') . "
                      SET
                          display='" . $value['display'] . "'
                      WHERE
                          article_id=" . $GLOBALS['plugin']->getValue('id') . "
                      AND
                          lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                      AND
                          field_id=" . $field_id
                ,__FILE__,__LINE__,0);
    
                XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_values') . "
                      SET
                          value='" .  implode("[;]", $value['multitext']) . "'
                      WHERE
                          article_id=" . $GLOBALS['plugin']->getValue('id') . "
                      AND
                          lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                      AND
                          field_id=" . $field_id . "
                      AND
                          position = 1"
                ,__FILE__,__LINE__,0);

                $search_properties .= " " . $value['display'] . " ";
                break;

            default:
            // default
            XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields_rel') . "
                      SET
                          display='" . $value['text'] . "'
                      WHERE
                          article_id=" . $GLOBALS['plugin']->getValue('id') . "
                      AND
                          lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                      AND
                          field_id=" . $field_id
            ,__FILE__,__LINE__,0);
            $search_properties .= " " . $display  . " ";
            break;

        }
    }
}


if(XT::queryRowsAffected() > 0){
    $do_search++;
}

// Images
if (is_array($GLOBALS['plugin']->getValue('image_versions'))){
    foreach ($GLOBALS['plugin']->getValue('image_versions') as $value){
        if($GLOBALS['plugin']->getValue('image_' . $value) !=''){
            XT::query("UPDATE
                           " . $GLOBALS['plugin']->getTable('images') . "
                       SET
                           image_id= " . $GLOBALS['plugin']->getValue('image_'  .$value) . ",
                           image_version= '" . $GLOBALS['plugin']->getValue('image_'  .$value . '_version') . "'
                       WHERE
                           article_id=" . $GLOBALS['plugin']->getValue('id') . "
                           AND position= " . $value
            ,__FILE__,__LINE__,0);
        }
    }
}
$main_image = 0;
$result = XT::query("SELECT image_id FROM " . $GLOBALS['plugin']->getTable('images') . "
 WHERE
 article_id=" . $GLOBALS['plugin']->getValue('id') . "
 AND is_main_image = 1"
,__FILE__,__LINE__);
while($row = $result->FetchRow()){
    $main_image = $row['image_id'];
}

if($do_search > 0){
    XT::log("Article " . $GLOBALS['plugin']->getValue('title',1) . " saved",__FILE__,__LINE__,XT_INFO);
    // Searchindex
    XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
    $search = new XT_SearchIndex($GLOBALS['plugin']->getValue('id'),$GLOBALS['plugin']->getContentType('Product'),1);
    $search->setLang($GLOBALS['plugin']->getValue('save_lang'));
    // add texts
    $search->add($GLOBALS['plugin']->getValue('subtitle',1), 3);
    $search->add($GLOBALS['plugin']->getValue('description',1), 3);
    $search->add($GLOBALS['plugin']->getValue('art_nr'), 3);
    $search->add($search_properties, 3);
    $search->build($GLOBALS['plugin']->getValue('title',1), $GLOBALS['plugin']->getValue('lead',1));
    $search->setImage($main_image);
    if($GLOBALS['plugin']->getValue('active')==1){
        $search->enable();
    }else{
        $search->disable();
    }

}else{
   //XT::log("Article " . $GLOBALS['plugin']->getValue('title') . " was <b>not</b> modified",__FILE__,__LINE__,XT_INFO);
}
$GLOBALS['preplugin_content'] .= "<script language=\"javascript\"><!--
yoffset = window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].x" . $GLOBALS['plugin']->getBaseId() . "_yoffset.value=yoffset
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>";

?>