<?php

    $GLOBALS['plugin']->setAdminModule('e');

    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('units') . " (id, standard) VALUES (NULL, '')",__FILE__,__LINE__);
    $insert_id = XT::getQueryData(XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable('units') . " ORDER by id DESC limit 1", __FILE__, __LINE__));
    $GLOBALS['plugin']->setValue('id', $insert_id[0]['id']);

?>