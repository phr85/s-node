<?php
$GLOBALS['plugin']->setSessionValue('object_id', $GLOBALS['plugin']->getValue('object_id'));
$GLOBALS['plugin']->setAdminModule('e');

XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable('content_types') . "
    SET
        title           = '" . $GLOBALS['plugin']->getValue('title') . "',
        open_url        = '" . $GLOBALS['plugin']->getValue('open_url') . "',
        content_table   = '" . $GLOBALS['plugin']->getValue('content_table') . "',
        title_field     = '" . $GLOBALS['plugin']->getValue('title_field') . "',
        icon            = '" . $GLOBALS['plugin']->getValue('icon') . "',
        id_field        = '" . $GLOBALS['plugin']->getValue('id_field') . "'
    WHERE 
        id = " . $GLOBALS['plugin']->getSessionValue('object_id')
, __FILE__, __LINE__);

?>