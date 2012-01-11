<?php

$GLOBALS['plugin']->setAdminModule('vp');

XT::query("
    DELETE FROM 
        " . $GLOBALS['plugin']->getTable('relations') . "
    WHERE
        content_id = '" . $GLOBALS['plugin']->getValue("project_id") . "' AND
        content_type = '" . $GLOBALS['plugin']->getContentType("Project") . "' AND
        target_content_id = '" . $GLOBALS['plugin']->getValue("before_content_id") . "' AND
        target_content_type = '" . $GLOBALS['plugin']->getValue("before_content_type") . "'
    ",__FILE__,__LINE__);

?>
