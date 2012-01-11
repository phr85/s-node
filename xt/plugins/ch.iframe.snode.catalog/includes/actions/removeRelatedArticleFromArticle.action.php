<?php
$data = XT::getQueryData(XT::query("SELECT position FROM " . $GLOBALS['plugin']->getTable('articles_relations') . " where main_article_id=" . $GLOBALS['plugin']->getSessionValue('articleID') . " AND article_id = " . $GLOBALS['plugin']->getValue('related_article_id'),__FILE__,__LINE__,0));
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('articles_relations') . " where main_article_id=" . $GLOBALS['plugin']->getSessionValue('articleID') . " AND article_id = " . $GLOBALS['plugin']->getValue('related_article_id'),__FILE__,__LINE__,0);
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('articles_relations') . " SET position = position-1 where main_article_id=" . $GLOBALS['plugin']->getSessionValue('articleID') . " AND position > " . ($data[0]['position']) ,__FILE__,__LINE__,0);

?>
