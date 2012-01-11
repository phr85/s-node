<?php

XT::query("UPDATE " . XT::getTable('galleries_details') . " SET active = 1 WHERE lang = '" . XT::getPluginLang() . "' AND node_id = " . XT::getValue('id'),__FILE__,__LINE__);
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex(XT::getValue('id'),$GLOBALS['plugin']->getContentType("Gallery"),1);
$search->enable();
?>
