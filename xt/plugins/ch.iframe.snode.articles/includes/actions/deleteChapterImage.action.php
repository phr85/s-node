<?php
$GLOBALS['plugin']->call("saveArticle");
XT::query("
    UPDATE 
        " . XT::getTable('articles_chapters_v') . " 
    SET 
        image = NULL, 
        image_version = NULL
    WHERE 
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND id = " . XT::getValue('article_id') . " 
        AND level=" .  (XT::getValue("chapter") + 1),__FILE__,__LINE__);

XT::setAdminModule("e");
?>
