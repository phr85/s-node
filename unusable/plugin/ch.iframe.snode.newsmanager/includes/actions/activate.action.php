<?php
// Activate News
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('newsmanager') . " SET active = 1 WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('newsmanager_v') . " SET active = 1 WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex($GLOBALS['plugin']->getValue('id'),$GLOBALS['plugin']->getContentType('News'),1, 'global');
$search->setLang($GLOBALS['plugin']->getActiveLang());
$search->enable();
?>