<?php

$result = XT::query("
    UPDATE 
        " . XT::getTable('newsmanager_chapters_v') . " 
    SET 
        active=0 
    WHERE 
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND 
        id =" . $GLOBALS['plugin']->getSessionValue('id') . " AND 
        level=" . $GLOBALS['plugin']->getValue("level")
,__FILE__,__LINE__);

$GLOBALS['plugin']->setAdminModule("e");

?>