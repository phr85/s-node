<?php

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
              lang='" . $GLOBALS['plugin']->getActiveLang() . "'
          ",__FILE__,__LINE__);

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
            $ingridient = XT::getQueryData(XT::query("SELECT count(*) as cnt, id FROM " . XT::getTable('i_details') . " WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND name='" . $name[$i] . "' Group by id",__FILE__,__LINE__));
            if($ingridient[0]['cnt']==0){
                // zutat erfassen als unvalidated mit unit als default und ammount 1 als default
                XT::query("insert into " . XT::getTable('ingridients') . "(`id`,`default_unit_id`,`default_ammount`,`validated`)
                values ( NULL," . $unit[$i] . "," . $anzahl[$i] . ",'0')",__FILE__,__LINE__);
                $insert_id = XT::getQueryData(XT::query("SELECT id FROM " . XT::getTable('ingridients') . " ORDER by id DESC limit 1", __FILE__, __LINE__));
                XT::query("insert into " . XT::getTable('i_details') . "(`id`,`lang`,`name`)
                values ( " . $insert_id[0]['id'] . ",'" . XT::getPluginLang() . "','" . $name[$i] . "')",__FILE__,__LINE__);
                // hinzufügen der zutat
                XT::query("INSERT into " . XT::getTable("r2i") . " SET
                recipe_id=" . XT::getValue("id") . ",
                ingridient_id=" . $insert_id[0]['id'] . ",
                unit_id=" . $unit[$i] . ",
                unit_ammount=" . $anzahl[$i] . ",
                position=$i",__FILE__,__LINE__);
            }else{
                // bestehende zutat hinzufügen
                XT::query("INSERT into " . XT::getTable("r2i") . " SET
                 recipe_id=" . XT::getValue("id") . ",
                 ingridient_id=" . $ingridient[0]['id'] . ",
                 unit_id=" . $unit[$i] . ",
                 unit_ammount=" . $anzahl[$i] . ",
                 position=$i",__FILE__,__LINE__);
            }

        }
    }
}





// Image



if(XT::getValue('image_id') !=''){
    $result = XT::Query("SELECT count(*) as cnt from " . XT::getTable('images') . "
               WHERE
                   recipe_id=" . XT::getValue('id') . "
               AND position= 1" ,__FILE__,__LINE__,0);

    $updateimage = XT::getQueryData($result);
    if($updateimage[0]['cnt'] == 1){
        XT::query("UPDATE
                       " . XT::getTable('images') . "
                   SET
                       image_id= " . XT::getValue('image_id') . ",
                       image_version= '2',
                       is_main_image=1
                   WHERE
                       recipe_id=" . XT::getValue('id') . "
                       AND position= 1" ,__FILE__,__LINE__,0);
    }else{
        XT::query("INSERT into
                       " . XT::getTable('images') . "
                   SET
                       image_id= " . XT::getValue('image_id') . ",
                       image_version= '2',
                       is_main_image=1,
                       recipe_id=" . XT::getValue('id') . ",
                       position= 1" ,__FILE__,__LINE__,0);
    }
}


XT::call("reorderIngridientsInRecipe");



?>