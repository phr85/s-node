<?php

// Delete News
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('newsmanager') . " WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('newsmanager_tree_rel') . " WHERE news_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('newsmanager_chapters') . " WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('newsmanager_v') . " WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('newsmanager_chapters_v') . " WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

?>