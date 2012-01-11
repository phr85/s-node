<?php

$result = XT::query("
    UPDATE 
        " . XT::getTable('articles_chapters_v') . " 
    SET 
        active=1 
    WHERE 
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND 
        id =" . $GLOBALS['plugin']->getSessionValue('id') . " AND 
        level=" . $GLOBALS['plugin']->getValue("level")
,__FILE__,__LINE__);

$GLOBALS['plugin']->setAdminModule("e");

?>