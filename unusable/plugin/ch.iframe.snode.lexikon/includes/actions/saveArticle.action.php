<?php
$GLOBALS['plugin']->setAdminModule('ea');
$do_search = 0;
// update data
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('articles') . "
          SET
              unit= '" . $GLOBALS['plugin']->getValue('unit') . "',
              quantity= '" . $GLOBALS['plugin']->getValue('quantity') . "',
              art_nr= '" . $GLOBALS['plugin']->getValue('art_nr',1) . "',
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
              lead= '" . $GLOBALS['plugin']->getValue('lead',1) . "',
              package= '" . $GLOBALS['plugin']->getValue('package',1) . "'
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
        XT::query("UPDATE " . $GLOBALS['plugin']->getTable('fields') . "
                  SET
                      value='" . $value . "'
                  WHERE
                      article_id=" . $GLOBALS['plugin']->getValue('id') . "
                  AND
                      lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'
                  AND
                      fieldname_id=" . $field_id
                  ,__FILE__,__LINE__,0);
        $search_properties .= " " . $value . " ";
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
                           image_version= " . $GLOBALS['plugin']->getValue('image_'  .$value . '_version') . "
                           WHERE
                           article_id=" . $GLOBALS['plugin']->getValue('id') . "
                           AND position= " . $value
                      ,__FILE__,__LINE__,0);
        }
    }
}

if($do_search > 0){
    XT::log("Article " . $GLOBALS['plugin']->getValue('title',1) . " saved",__FILE__,__LINE__,XT_INFO);
    // Searchindex
    include_once(CLASS_DIR . 'searchindex.class.php');
    $search = new XT_SearchIndex($GLOBALS['plugin']->getValue('id'),$GLOBALS['plugin']->getContentType('Lexikon'),1,'global');
    $search->setLang($GLOBALS['plugin']->getValue('save_lang'));
    // add texts
    $search->add($GLOBALS['plugin']->getValue('package',1), 3);
    $search->add($GLOBALS['plugin']->getValue('art_nr'), 3);
    $search->add($search_properties, 3);
    $search->build($GLOBALS['plugin']->getValue('title',1), $GLOBALS['plugin']->getValue('lead',1));
    
    if($GLOBALS['plugin']->getValue('active')==1){
        $search->enable();
    }else{
        $search->disable();
    }


}else{
    //XT::log("Article " . $GLOBALS['plugin']->getValue('title') . " was <b>not</b> modified",__FILE__,__LINE__,XT_INFO);
}
echo "<script language=\"javascript\"><!--
yoffset = window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].x" . $GLOBALS['plugin']->getBaseId() . "_yoffset.value=yoffset
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>";

?>
