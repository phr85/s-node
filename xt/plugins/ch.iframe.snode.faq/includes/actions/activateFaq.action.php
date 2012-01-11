<?php

XT::query("
    UPDATE 
        " . XT::getTable("faq") . " 
    SET 
        active = 1
    WHERE
        id = " . XT::getValue("id") . " AND
        lang = '" . XT::getActiveLang() . "'
",__FILE__,__LINE__);

XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex(XT::getValue('id'),XT::getContentType("FAQ Article"), 1);
$search->setLang(XT::getActiveLang());
$search->enable();

?>