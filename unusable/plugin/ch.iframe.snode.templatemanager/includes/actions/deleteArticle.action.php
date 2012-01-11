<?php
if(is_numeric($GLOBALS['plugin']->getValue("article_id"))){

    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("faq_rel") . " WHERE node_id = " . $GLOBALS['plugin']->getValue("node_id") . " AND article_id = " . $GLOBALS['plugin']->getValue("article_id"),__FILE__,__LINE__);

}
?>