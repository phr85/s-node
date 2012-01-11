<?php
$GLOBALS['plugin']->call("saveNewsletter");
XT::query("
    UPDATE 
        " . XT::getTable('newsletter_chapters') . " 
    SET 
        image = NULL, 
        image_version = NULL
    WHERE 
        id = " . XT::getValue('newsletter_id') . " 
        AND level=" .  (XT::getValue("level")),__FILE__,__LINE__);

XT::setAdminModule("e");
?>
