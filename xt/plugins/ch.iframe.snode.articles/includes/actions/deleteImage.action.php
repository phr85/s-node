<?php

$GLOBALS['plugin']->call("saveArticle");

XT::query("
    UPDATE 
        " . $GLOBALS['plugin']->getTable('articles_v') . " 
    SET 
        image = '', 
        image_version = ''
    WHERE 
        rid = '" . $GLOBALS['plugin']->getValue('rid') . "' AND 
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND 
        id = " . $GLOBALS['plugin']->getValue('article_id')
,__FILE__,__LINE__,0);

$GLOBALS['plugin']->setAdminModule("e");

?>
