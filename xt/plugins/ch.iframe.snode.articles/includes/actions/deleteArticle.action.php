<?php

$result = XT::query("SELECT id FROM " . XT::getTable('articles_v') . " WHERE lang != '" . $GLOBALS['plugin']->getActiveLang() . "' AND id = '" . XT::getValue('id') . "'",__FILE__,__LINE__);

// Delete News
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('articles') . " WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('articles_chapters') . " WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('articles_v') . " WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('articles_chapters_v') . " WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

// Check for other language versions
if($result->RecordCount() < 1){
    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('articles_tree_rel') . " WHERE article_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
}

XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex($GLOBALS['plugin']->getValue('id'),$GLOBALS['plugin']->getContentType("Article"),0);
$search->setLang($GLOBALS['plugin']->getActiveLang());
$search->delete();

?>