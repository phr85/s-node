<?php
XT::call("saveInfo");
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('navigation_details') . " SET active = 1 WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND node_id = " . $GLOBALS['plugin']->getValue('tpl_id'),__FILE__,__LINE__);

XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex($GLOBALS['plugin']->getValue('tpl_id'),$GLOBALS['plugin']->getContentType('Page'),1, 'global');
$search->setLang($GLOBALS['plugin']->getActiveLang());
$search->enable();
?>
