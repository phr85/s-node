<?php
$GLOBALS['plugin']->setSessionValue('previousAdminModule', $GLOBALS['plugin']->getSessionValue('adminModule'));


XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('promo') . " (id, kummulierbar) VALUES (NULL, 1)",__FILE__,__LINE__);
$insert_id = XT::getQueryData(XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable('promo') . " ORDER by id DESC limit 1", __FILE__, __LINE__));
$GLOBALS['plugin']->setValue('id', $insert_id[0]['id']);
$GLOBALS['plugin']->setAdminModule('promoedit');
?>
