<?php
class XT_ch_iframe_snode_search {

    function addNonword($word, &$plugin){
        XT::query("
            INSERT INTO " . $GLOBALS['plugin']->getTable('search_nonwords') . " (
                id, two, kw)
            VALUES (
                NULL,
                '" . substr(strtolower(trim($word)), 0,2) . "',
               '" . strtolower(trim($word)) . "'
               )");
        if($GLOBALS['db']->ErrorNo() ==1062){
            XT::log("Keyword <b>" . strtolower(trim($word)) . "</b> already exists ",__FILE__,__LINE__,XT_ERROR);
        }
}
}
?>