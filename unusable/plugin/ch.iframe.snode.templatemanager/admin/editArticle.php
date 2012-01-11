<?php

if(is_numeric($GLOBALS['plugin']->getValue("article_id"))){
    $GLOBALS['plugin']->setSessionValue("article_id", $GLOBALS['plugin']->getValue("article_id"));
}

$GLOBALS['plugin']->contribute('edit_article_buttons','Save', 'saveArticle','','0');

XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("faq_details") . "
    WHERE
        article_id = " . $GLOBALS['plugin']->getSessionValue("article_id") . "
        AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    ",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("ARTICLE", $data[0]);

$content = XT::build("editArticle.tpl");

?>
