<?php
//Move Keyword to nonwords
require_once(CLASS_DIR . "ch.iframe.snode.search.class.php");
$result = XT::query("SELECT kw FROM " . $GLOBALS['plugin']->getTable('search_kw') . " WHERE id =" . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
while($row = $result->FetchRow()){
    XT_ch_iframe_snode_search::addNonword($row['kw'], $plugin);
}

XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('search_assoc_global') . " WHERE KW_id =" . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('search_kw') . " WHERE id =" . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
XT::log("Keyword has been moved and assocs deleted",__FILE__,__LINE__,XT_INFO);
$GLOBALS['plugin']->setAdminModule('kw');
?>
