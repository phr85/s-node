<?php

XT::query("
    DELETE FROM
        " . $GLOBALS['plugin']->getTable("relations") . " 
    WHERE
        content_id = " . $GLOBALS['plugin']->getValue("project_id") . " AND
        content_type = " . $GLOBALS['plugin']->getContentType("Project") . " AND
        target_content_id = 0 AND
        target_content_type = 0
",__FILE__,__LINE__);

XT::query("
    INSERT INTO 
        " . $GLOBALS['plugin']->getTable("relations") . " 
    (
        content_id,
        content_type,
        target_content_id,
        target_content_type
    ) VALUES (
        " . $GLOBALS['plugin']->getValue("file_id") . ",
        " . $GLOBALS['plugin']->getContentType("File") . ",
        0,
        0
    )
",__FILE__,__LINE__);

XT::query("
    INSERT INTO 
        " . $GLOBALS['plugin']->getTable("relations") . " 
    (
        target_content_id,
        target_content_type,
        content_id,
        content_type
    ) VALUES (
        " . $GLOBALS['plugin']->getValue("file_id") . ",
        " . $GLOBALS['plugin']->getContentType("File") . ",
        0,
        0
    )
",__FILE__,__LINE__);

$GLOBALS['plugin']->setValue("target_content_id",0);
$GLOBALS['plugin']->setValue("target_content_type",0);

$GLOBALS['plugin']->setAdminModule("er");

?>
