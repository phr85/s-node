<?php

$GLOBALS['plugin']->setAdminModule('er');

XT::query("
    UPDATE 
        " . $GLOBALS['plugin']->getTable('relations') . "
    SET
        content_id = '" . $GLOBALS['plugin']->getValue("project_id") . "',
        content_type = '" . $GLOBALS['plugin']->getContentType("Project") . "',
        target_content_id = '" . $GLOBALS['plugin']->getValue("target_content_id") . "',
        target_content_type = '" . $GLOBALS['plugin']->getValue("target_content_type") . "'
    WHERE
        content_id = '" . $GLOBALS['plugin']->getValue("project_id") . "' AND
        content_type = '" . $GLOBALS['plugin']->getContentType("Project") . "' AND
        target_content_id = '" . $GLOBALS['plugin']->getValue("before_content_id") . "' AND
        target_content_type = '" . $GLOBALS['plugin']->getValue("before_content_type") . "'
    ",__FILE__,__LINE__);
    
XT::query("
    UPDATE 
        " . $GLOBALS['plugin']->getTable('relations') . "
    SET
        target_content_id = '" . $GLOBALS['plugin']->getValue("project_id") . "',
        target_content_type = '" . $GLOBALS['plugin']->getContentType("Project") . "',
        content_id = '" . $GLOBALS['plugin']->getValue("target_content_id") . "',
        content_type = '" . $GLOBALS['plugin']->getValue("target_content_type") . "'
    WHERE
        target_content_id = '" . $GLOBALS['plugin']->getValue("project_id") . "' AND
        target_content_type = '" . $GLOBALS['plugin']->getContentType("Project") . "' AND
        content_id = '" . $GLOBALS['plugin']->getValue("before_content_id") . "' AND
        content_type = '" . $GLOBALS['plugin']->getValue("before_content_type") . "'
    ",__FILE__,__LINE__);

?>
