<?php
$data = XT::getQueryData(XT::query("SELECT position FROM " . $GLOBALS['plugin']->getTable('tree2articles') . " where node_id=" . $GLOBALS['plugin']->getValue('node_id') . " AND article_id = " . $GLOBALS['plugin']->getValue('article_id'),__FILE__,__LINE__,0));
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('tree2articles') . " where node_id=" . $GLOBALS['plugin']->getValue('node_id') . " AND article_id = " . $GLOBALS['plugin']->getValue('article_id'),__FILE__,__LINE__,0);
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('tree2articles') . " SET position = position-1 where node_id=" . $GLOBALS['plugin']->getValue('node_id') . " AND position > " . ($data[0]['position']) ,__FILE__,__LINE__,0);

?>
