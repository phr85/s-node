<?php
$GLOBALS['plugin']->setSessionValue('previousAdminModule', $GLOBALS['plugin']->getSessionValue('adminModule'));
$GLOBALS['plugin']->setAdminModule('tae');

XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('taxes') . " (id, value) VALUES (NULL, '')",__FILE__,__LINE__);
$insert_id = XT::getQueryData(XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable('taxes') . " ORDER by id DESC limit 1", __FILE__, __LINE__));
$GLOBALS['plugin']->setValue('id', $insert_id[0]['id']);
?>
