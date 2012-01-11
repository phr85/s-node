<?php
/**
 * Add Nonword
 */

require_once(CLASS_DIR . "ch.iframe.snode.search.class.php");
$words = array();
$words = explode(" ", trim($GLOBALS['plugin']->getValue('keyword')));
foreach ($words as $word){
    XT_ch_iframe_snode_search::addNonword($word, $plugin);
}
$GLOBALS['plugin']->setAdminModule('nw');

?>
