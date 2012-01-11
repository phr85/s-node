<?php
$GLOBALS['plugin']->setSessionValue('previousAdminModule', $GLOBALS['plugin']->getSessionValue('adminModule'));
    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('articles') . " (id, unit, quantity, art_nr, active,cdate, pkg_unit) VALUES (NULL, NULL, NULL, NULL, 0," . TIME . ", NULL)",__FILE__,__LINE__);
    $insert_id = XT::getQueryData(XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable('articles') . " ORDER by id DESC limit 1", __FILE__, __LINE__));
    $GLOBALS['plugin']->setValue('id', $insert_id[0]['id']);

    foreach ($GLOBALS['cfg']->getLangs() as $key => $lang){
        XT::query("INSERT INTO
                      " . $GLOBALS['plugin']->getTable('articles_details') . "
                      (id, lang, title, subtitle, lead, active)
                  VALUES
                      (" . $GLOBALS['plugin']->getValue('id') . ", '" . $key . "', '', NULL, NULL, NULL)",__FILE__,__LINE__);

    }
    $GLOBALS['plugin']->setAdminModule('ea');
    XT::log("New article ",__FILE__,__LINE__,XT_INFO);
?>