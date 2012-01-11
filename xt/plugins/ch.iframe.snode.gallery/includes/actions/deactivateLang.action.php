<?php

XT::query("UPDATE " . XT::getTable('galleries_details') . " SET active = 0 WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND node_id = " . XT::getValue('id'),__FILE__,__LINE__);
require_once(CLASS_DIR . "searchindex.class.php");
$search = new XT_SearchIndex(XT::getValue('id'),$GLOBALS['plugin']->getContentType("Gallery"),1);
$search->disable();

?>
