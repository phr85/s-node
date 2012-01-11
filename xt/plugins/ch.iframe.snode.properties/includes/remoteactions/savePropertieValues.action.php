<?php

// include tables and property types config
include(PLUGIN_DIR . "ch.iframe.snode.properties/includes/config.ext.inc.php");
 if (XT::getValue("XT_PROP_save_lang") != ""){
     $savelang = XT::getValue("XT_PROP_save_lang");
 }else {
     $savelang = XT::getPluginLang();
 }

// Article Properties
if(is_array(XT::getValue('XT_PROP_property'))){
    foreach (XT::getValue('XT_PROP_property') as $property_id => $value){
        switch ($value['type']) {
            case 0:
                // Text
                XT::query("UPDATE " . XT::getTable("values") . "
                  SET
                      value='" . $value['text'] . "'
                  WHERE
                      content_id=" . XT::getValue('XT_PROP_content_id') . "
                  AND
                      lang='" . $savelang . "'
                  AND
                      content_type=" . XT::getValue("XT_PROP_content_type") . "
                  AND
                      property_id=" . $property_id
                ,__FILE__,__LINE__);

                $search_properties .= " " . $value['text'] . " ";
                break;

            case 1:
                // bool

                XT::query("UPDATE " . XT::getTable("values") . "
                  SET
                      value='" .  $value['boolean'] . "'
                  WHERE
                      content_id=" . XT::getValue('XT_PROP_content_id') . "
                  AND
                      lang='" . $savelang . "'
                  AND
                      content_type=" . XT::getValue("XT_PROP_content_type") . "
                  AND
                      property_id=" . $property_id . "
                  AND
                      level = 1"
                ,__FILE__,__LINE__,0);
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
                XT::query("UPDATE " . XT::getTable("values") . "
                  SET
                      value='" .  $value['decimal1'] . "'
                  WHERE
                      content_id=" . XT::getValue('XT_PROP_content_id') . "
                  AND
                      lang='" . $savelang . "'
                  AND
                      content_type=" . XT::getValue("XT_PROP_content_type") . "
                  AND
                      property_id=" . $property_id . "
                  AND
                      level = 1"
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

                XT::query("UPDATE " . XT::getTable("values") . "
                  SET
                      value='" . $value['decimal1'] . " - " . $value['decimal2'] . "'
                  WHERE
                      content_id=" . XT::getValue('XT_PROP_content_id') . "
                  AND
                      lang='" . $savelang . "'
                  AND
                      content_type=" . XT::getValue("XT_PROP_content_type") . "
                  AND
                      property_id=" . $property_id
                ,__FILE__,__LINE__,0);

                XT::query("DELETE FROM " . XT::getTable("values") . "
               WHERE
                      content_id=" . XT::getValue('XT_PROP_content_id') . "
                  AND
                      lang='" . $savelang . "'
                  AND
                      content_type=" . XT::getValue("XT_PROP_content_type") . "
                  AND
                      property_id=" . $property_id ,__FILE__,__LINE__);


                XT::query("INSERT INTO " . XT::getTable("values") . "
                  SET
                      value='" .  $value['decimal1'] . "',
                      label='min',
                      content_id=" . XT::getValue('XT_PROP_content_id') . ",
                      lang='" . $savelang . "',
                      property_id=" . $property_id . ",
                      level = 1"
                ,__FILE__,__LINE__,0);

                XT::query("INSERT INTO " . XT::getTable("values") . "
                  SET
                      value='" .  $value['decimal2'] . "',
                      label='max',
                      content_id=" . XT::getValue('XT_PROP_content_id') . ",
                      lang='" . $savelang . "',
                      property_id=" . $property_id . ",
                      level = 2"
                ,__FILE__,__LINE__,0);
                $search_properties .= $value['decimal1']  . " - " . $value['decimal2'];
                break;

            case 3:
                // dropdown
                XT::query("UPDATE " . XT::getTable("values") . "
                  SET
                      value='" .  $value['dropdown'] . "'
                  WHERE
                      content_id=" . XT::getValue('XT_PROP_content_id') . "
                  AND
                      lang='" . $savelang . "'
                  AND
                      content_type=" . XT::getValue("XT_PROP_content_type") . "
                  AND
                      property_id=" . $property_id . "
                  AND
                      level = 1"
                ,__FILE__,__LINE__,0);

                $search_properties .= " " . $value['dropdown'] . " ";
                break;

            case 9:
                // Radios

                XT::query("UPDATE " . XT::getTable("values") . "
                  SET
                      value='" .  $value['dropdown'] . "'
                  WHERE
                      content_id=" . XT::getValue('XT_PROP_content_id') . "
                  AND
                      content_type=" . XT::getValue("XT_PROP_content_type") . "
                  AND
                      lang='" . $savelang . "'
                  AND
                      property_id=" . $property_id . "
                  AND
                      level = 1"
                ,__FILE__,__LINE__,0);


                $search_properties .= " " . $value['dropdown'] . " ";
                break;


            case 4:
                unset($display);
                unset($displayarray);
                $multilabels = array();

                // Checkboxes
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

                XT::query("DELETE FROM " . XT::getTable("values") . "
               WHERE
                      content_id=" . XT::getValue('XT_PROP_content_id') . "
                  AND
                      lang='" . $savelang . "'
                  AND
                      content_type=" . XT::getValue("XT_PROP_content_type") . "
                  AND
                      property_id=" . $property_id ,__FILE__,__LINE__);
                $i = 1;

                if(is_array($value['multi'])){
                    foreach ($value['multi'] as $multivals){
                        XT::query("INSERT INTO " . XT::getTable("values") . "
                  SET
                      value='" .  $multivals . "',
                      label='" . $value['label'][$multivals] . "',
                      content_id=" . XT::getValue('XT_PROP_content_id') . ",
                      content_type=" . XT::getValue("XT_PROP_content_type") . ",
                      lang='" . $savelang . "',
                      property_id=" . $property_id . ",
                      level = " . $i
                        ,__FILE__,__LINE__,0);
                        $i++;
                        $displayarray[] = $value['label'][$multivals];
                    }
                    $display = implode(', ',$displayarray);
                }else {

                    XT::log("Field " . $property_id . " No value selected, using default values",__FILE__,__LINE__,XT_WARNING);
                }

                $search_properties .= " " . $display . " ";
                break;

            case 6:
                // Relation

                // Damit der "leere" erste Eintrag nicht gel√∂scht wird falls man nichts eintragen will
                if(XT::getValue('XT_PROP_property_' . $property_id . '_1_target_content_id') == "") {
                    XT::query("
                        DELETE FROM
                            " . XT::getTable("values") . "
                        WHERE
                            property_id = " . $property_id . " AND
                            content_type = " . XT::getValue("XT_PROP_content_type") . " AND
		                    lang='" . $savelang . " 'AND
                            content_id = " . XT::getValue('XT_PROP_content_id') . " AND
                            level > 1
                    ",__FILE__,__LINE__);
                }
                else {
                    XT::query("
                        DELETE FROM
                            " . XT::getTable("values") . "
                        WHERE
                            property_id = " . $property_id . " AND
                            content_type = " . XT::getValue("XT_PROP_content_type") . " AND
                            lang='" . $savelang . " 'AND
                            content_id = " . XT::getValue('XT_PROP_content_id') . "
                    ",__FILE__,__LINE__);
                }

                // Es sind maximal 99 Eintraege moeglich, der Level bleibt erhalten
                for($level = 1; $level < 100; $level++) {
                    if(XT::getValue('XT_PROP_property_' . $property_id . '_' . $level . '_target_content_id') != "") {

                        XT::query("
                            INSERT INTO " . XT::getTable("values") . " (
                                property_id,
                                content_type,
                                content_id,
                                lang,
                                level,
                                label,
                                value
                            ) VALUES (
                                " . $property_id . ",
                                " . XT::getValue("XT_PROP_content_type") . ",
                                " . XT::getValue('XT_PROP_content_id') . ",
                                '" . $savelang . "',
                                " . $level . ",
                                '" . XT::getValue('XT_PROP_property_' . $property_id . '_' . $level . '_target_content_id_title') . "',
                                '" . XT::getValue('XT_PROP_property_' . $property_id . '_' . $level . '_target_content_id') . "'
                            )
                        ",__FILE__,__LINE__);
                    }
                }

                break;

            case 7:
                 // Relation

                // Damit der "leere" erste Eintrag nicht gel√∂scht wird falls man nichts eintragen will
                if(XT::getValue('XT_PROP_property_' . $property_id . '_1_target_content_id') == "") {
                    XT::query("
                        DELETE FROM
                            " . XT::getTable("values") . "
                        WHERE
                            property_id = " . $property_id . " AND
                            content_type = " . XT::getValue("XT_PROP_content_type") . " AND
                            lang='" . $savelang . " 'AND
                            content_id = " . XT::getValue('XT_PROP_content_id') . " AND
                            level > 1
                    ",__FILE__,__LINE__);
                }
                else {
                    XT::query("
                        DELETE FROM
                            " . XT::getTable("values") . "
                        WHERE
                            property_id = " . $property_id . " AND
                            content_type = " . XT::getValue("XT_PROP_content_type") . " AND
                            lang='" . $savelang . " 'AND
                            content_id = " . XT::getValue('XT_PROP_content_id') . "
                    ",__FILE__,__LINE__);
                }

                // Es sind maximal 99 Eintraege moeglich, und der Level wird erhalten
                for($level = 1; $level < 100; $level++) {
                    if(XT::getValue('XT_PROP_property_' . $property_id . '_' . $level . '_target_content_id') != "") {

                        XT::query("
                            INSERT INTO " . XT::getTable("values") . " (
                                property_id,
                                content_type,
                                content_id,
                                lang,
                                level,
                                label,
                                value
                            ) VALUES (
                                " . $property_id . ",
                                " . XT::getValue("XT_PROP_content_type") . ",
                                " . XT::getValue('XT_PROP_content_id') . ",
                                '" . $savelang . "',
                                " . $level . ",
                                '" . XT::getValue('XT_PROP_property_' . $property_id . '_' . $level . '_target_content_id_title') . "',
                                '" . XT::getValue('XT_PROP_property_' . $property_id . '_' . $level . '_target_content_id') . "'
                            )
                        ",__FILE__,__LINE__);
                    }
                }

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

                XT::query("DELETE FROM " . XT::getTable("values") . "
               WHERE
                      content_id=" . XT::getValue('XT_PROP_content_id') . "
                  AND
                      lang='" . $savelang . "'
                  AND
                      content_type=" . XT::getValue("XT_PROP_content_type") . "
                  AND
                      property_id=" . $property_id ,__FILE__,__LINE__);
                $i = 1;

                if(is_array($value['multi'])){
                    foreach ($value['multi'] as $multivals){
                        XT::query("INSERT INTO " . XT::getTable("values") . "
                  SET
                      value='" .  $multivals . "',
                      label='" . $value['label'][$multivals] . "',
                      content_id=" . XT::getValue('XT_PROP_content_id') . ",
                      content_type=" . XT::getValue("XT_PROP_content_type") . ",
                      lang='" . $savelang . "',
                      property_id=" . $property_id . ",
                      level = " . $i
                        ,__FILE__,__LINE__,0);
                        $i++;
                        $displayarray[] = $value['label'][$multivals];
                    }
                    $display = implode(', ',$displayarray);
                }else {

                    XT::log("Field " . $property_id . " No value selected, using default values",__FILE__,__LINE__,XT_WARNING);
                }

                $search_properties .= " " . $display . " ";
                break;

            case 11:
                // File
                XT::query("UPDATE " . XT::getTable("values") . "
                  SET
                      value='" . XT::getValue('XT_PROP_property_' . $property_id . '__target_content_id') . "',
                      label='" . XT::getValue('XT_PROP_property_' . $property_id . '__target_content_id_title') . "'
                  WHERE
                      content_id=" . XT::getValue('XT_PROP_content_id') . "
                  AND
                      lang='" . $savelang . "'
                  AND
                      content_type=" . XT::getValue("XT_PROP_content_type") . "
                  AND
                      property_id=" . $property_id
                ,__FILE__,__LINE__);

                $search_properties .= " " . $value['text'] . " ";
                break;
        }
    }
}

?>