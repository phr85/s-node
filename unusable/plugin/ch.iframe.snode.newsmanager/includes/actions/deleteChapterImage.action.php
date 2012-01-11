<?php
$GLOBALS['plugin']->call("saveNews");
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('newsmanager_chapters_v') . " SET image = NULL, image_version = NULL
 WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND id = " . $GLOBALS['plugin']->getValue('article_id') . " AND level=" .  ($GLOBALS['plugin']->getValue("chapter") + 1),__FILE__,__LINE__);

$GLOBALS['plugin']->setAdminModule("e");
?>
