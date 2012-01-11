<?php
$GLOBALS['plugin']->setAdminModule('ea');
$do_search = 0;
// wenn keine id gegeben wurde mit dem sessionwert machen
if(!XT::getValue('id')){
        $GLOBALS['plugin']->setValue('id', XT::getSessionValue('recipeID'));
}

// update data
XT::query("UPDATE " . XT::getTable('rezepte') . "
          SET
              portions= '" . XT::getValue('portions') . "',
              create_duration= '" . XT::getValue('create_duration') . "',
              rest_duration= '" . XT::getValue('rest_duration') . "',
              kcal= '" . XT::getValue('kcal') . "',
              complexity= '" . XT::getValue('complexity') . "',
              ca_price= '" . XT::getValue('ca_price') . "',
              m_date=" . TIME . ",
              m_user=" . XT::getUserID() . "
          WHERE
              id=" . XT::getValue('id') . "
          ",__FILE__,__LINE__);
if(XT::queryRowsAffected() > 0){
    $do_search++;
}
// recipe Details
XT::query("UPDATE " . XT::getTable('r_details') . "
          SET
              title= '" . XT::getValue('title') . "',
              subtitle= '" . XT::getValue('subtitle') . "',
              description= '" . XT::getValue('description') . "',
              making= '" . XT::getValue('making') . "'
          WHERE
              id=" . XT::getValue('id') . "
          AND
              lang='" . XT::getValue("save_lang") . "'
          ",__FILE__,__LINE__);
if(XT::queryRowsAffected() > 0){
    $do_search++;
}else {
	XT::query("INSERT into " . XT::getTable('r_details') . "
          SET
              title= '" . XT::getValue('title') . "',
              subtitle= '" . XT::getValue('subtitle') . "',
              description= '" . XT::getValue('description') . "',
              making= '" . XT::getValue('making') . "',
              id=" . XT::getValue('id') . ",
              lang='" . $GLOBALS['plugin']->getActiveLang() . "'
          ",__FILE__,__LINE__);
}


// Zutaten
$anzahl = XT::getValue("ammount");
$unit = XT::getValue("unit");
$name = XT::getValue("name");
$ing_id = XT::getValue("ing_id");

// doppelte finden
foreach ($ing_id as $key => $value) {
    $doppelt[$value]++;
}
$mehrfache = array();
foreach ($doppelt as $key => $value) {
    if($value > 1){
        $mehrfache[] = $key;
    }
}

foreach ($name as $key => $value) {
    if($key < 997){
        if(!XT::getConfig("multiingredient") && in_array($ing_id[$key],$mehrfache)){
            XT::log(XT::translate("Multiple input of") . " " . $name[$key] . ", " . XT::translate("no changes"),__FILE__,__LINE__,XT_ERROR);
        }else {
            XT::query("UPDATE " . XT::getTable("r2i") . " set
            ingridient_id=" . $ing_id[$key] . ",
            unit_id=" . $unit[$key] . ",
            unit_ammount=" . $anzahl[$key] . "
            where `recipe_id`='" . XT::getValue("id") . "' and `position`='" . $key . "'",__FILE__,__LINE__);
            XT::query("UPDATE " . XT::getTable("i_details") . " set name='" . $name[$key] . "' WHERE id=" .  $ing_id[$key] . " AND lang='" . XT::getValue("save_lang") . "'",__FILE__,__LINE__);

        }
    }
}

//neue adden
for ($i=997;$i<1000;$i++){
    if(!empty($name[$i]) && !empty($unit[$i]) && $anzahl[$i]!=''){
        // schnelles hinzufügen weil zutaten id bekannt ist
        if(!empty($ing_id[$i])){
            if(!XT::getConfig("multiingredient") && in_array($ing_id[$i],$mehrfache)){
                XT::log($name[$i] . " " . XT::translate("already exists"),__FILE__,__LINE__,XT_ERROR);
            }else {
                XT::query("INSERT into " . XT::getTable("r2i") . " SET
                 recipe_id=" . XT::getValue("id") . ",
                 ingridient_id=" . $ing_id[$i] . ",
                 unit_id=" . $unit[$i] . ",
                 unit_ammount=" . $anzahl[$i] . ",
                 position=$i",__FILE__,__LINE__);
            }
        }else {
            // nur erfassen wenn es auch noch nicht existiert
            $ingridient = XT::getQueryData(XT::query("SELECT count(*) as cnt FROM " . XT::getTable('i_details') . " WHERE name='" . $name[$i] . "'",__FILE__,__LINE__));
            if($ingridient[0]['cnt']==0){
                // zutat erfassen als unvalidated mit unit als default und ammount 1 als default
                XT::query("insert into " . XT::getTable('ingridients') . "(`id`,`default_unit_id`,`default_ammount`,`validated`)
                values ( NULL," . $unit[$i] . "," . $anzahl[$i] . ",'0')",__FILE__,__LINE__);
                $insert_id = XT::getQueryData(XT::query("SELECT id FROM " . XT::getTable('ingridients') . " ORDER by id DESC limit 1", __FILE__, __LINE__));
                XT::query("insert into " . XT::getTable('i_details') . "(`id`,`lang`,`name`)
                values ( " . $insert_id[0]['id'] . ",'" . XT::getValue("save_lang") . "','" . $name[$i] . "')",__FILE__,__LINE__);
                // hinzufügen der zutat
                XT::query("INSERT into " . XT::getTable("r2i") . " SET
                recipe_id=" . XT::getValue("id") . ",
                ingridient_id=" . $insert_id[0]['id'] . ",
                unit_id=" . $unit[$i] . ",
                unit_ammount=" . $anzahl[$i] . ",
                position=$i",__FILE__,__LINE__);
            }
        }
    }
}
XT::call("reorderIngridientsInRecipe");




// Images
if (is_array(XT::getValue('image_versions'))){
    foreach (XT::getValue('image_versions') as $value){
        if(XT::getValue('image_' . $value) !=''){
            XT::query("UPDATE
                           " . XT::getTable('images') . "
                       SET
                           image_id= " . XT::getValue('image_'  .$value) . ",
                           image_version= '" . XT::getValue('image_'  .$value . '_version') . "'
                       WHERE
                           recipe_id=" . XT::getValue('id') . "
                           AND position= " . $value
            ,__FILE__,__LINE__,0);
        }
    }
}
$main_image = 0;
$result = XT::query("SELECT image_id FROM " . XT::getTable('images') . "
 WHERE
 recipe_id=" . XT::getValue('id') . "
 AND is_main_image = 1"
,__FILE__,__LINE__);
while($row = $result->FetchRow()){
    $main_image = $row['image_id'];
}

if($do_search > 0){
    XT::log("Recipe " . XT::getValue('title') . " saved",__FILE__,__LINE__,XT_INFO);
    // Searchindex
    XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
    $search = new XT_SearchIndex(XT::getValue('id'),XT::getContentType('Recipe'),1);
    $search->setLang(XT::getValue("save_lang"));
    // add texts
    $search->add(XT::getValue('subtitle'), 3);
    $search->add(XT::getValue('description'), 3);
    $search->add(XT::getValue('making'), 2);
    $search->add(implode(" ", $name), 1);
    $search->build(XT::getValue('title'), XT::getValue('description',1));
    $search->setImage($main_image);
    if(XT::getValue('active')==1){
        $search->enable();
    }else{
        $search->disable();
    }

}else{
    //XT::log("Recipe " . XT::getValue('title') . " was <b>not</b> modified",__FILE__,__LINE__,XT_INFO);
}
$GLOBALS['preplugin_content'] .= "<script language=\"javascript\" type=\"text/javascript\"><!--
yoffset = window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].x" . $GLOBALS['plugin']->getBaseId() . "_yoffset.value=yoffset
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>";

?>