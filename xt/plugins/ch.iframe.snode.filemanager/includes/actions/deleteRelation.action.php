<?php

$GLOBALS['plugin']->setAdminModule('vf');

XT::query("
    DELETE FROM 
        " . $GLOBALS['plugin']->getTable('relations') . "
    WHERE
        content_id = '" . $GLOBALS['plugin']->getValue("file_id") . "' AND
        content_type = '" . $GLOBALS['plugin']->getContentType("File") . "' AND
        target_content_id = '" . $GLOBALS['plugin']->getValue("before_content_id") . "' AND
        target_content_type = '" . $GLOBALS['plugin']->getValue("before_content_type") . "'
    ",__FILE__,__LINE__);

?>
