<?php

// Delete Map
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('gmap') . " WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

/*XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex($GLOBALS['plugin']->getValue('id'),$GLOBALS['plugin']->getContentType("Gmap"),0);
$search->setLang($GLOBALS['plugin']->getActiveLang());
$search->delete();*/

?>