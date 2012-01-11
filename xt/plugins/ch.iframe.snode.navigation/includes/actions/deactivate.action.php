<?php

XT::query("UPDATE " . $GLOBALS['plugin']->getTable('navigation') . " SET active = 0 WHERE id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('navigation_details') . " SET active = 0 WHERE nav_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

// Activate search index
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex($GLOBALS['plugin']->getValue("id"),$GLOBALS['plugin']->getContentType("Page"));
$search->disable();

?>
