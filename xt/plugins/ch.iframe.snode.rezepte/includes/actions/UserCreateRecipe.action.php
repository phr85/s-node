<?php

XT::query("INSERT INTO " . XT::getTable('rezepte') . " (id, c_date, c_user,active_by_user) VALUES (NULL, " . TIME . ", " . XT::getUserID() . ",0)",__FILE__,__LINE__);
$insert_id = XT::getQueryData(XT::query("SELECT id FROM " . XT::getTable('rezepte') . " ORDER by id DESC limit 1", __FILE__, __LINE__));
$GLOBALS['plugin']->setValue('id', $insert_id[0]['id']);

foreach ($GLOBALS['cfg']->getLangs() as $key => $lang){
    XT::query("INSERT INTO
                      " . XT::getTable('r_details') . "
                      (id, lang, title)
                  VALUES
                      (" . XT::getValue('id') . ", '" . $key . "', '')",__FILE__,__LINE__);

}
?>