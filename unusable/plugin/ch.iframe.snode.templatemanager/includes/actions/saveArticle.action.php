<?php

$GLOBALS['plugin']->setAdminModule('ea');

XT::query("
    UPDATE 
        " . $GLOBALS['plugin']->getTable('faq_details') . "
    SET
        title = '" . $GLOBALS['plugin']->getValue("title") . "',
        question_detail = '" . $GLOBALS['plugin']->getValue("question_detail") . "',
        answer = '" . $GLOBALS['plugin']->getValue("answer") . "'
    WHERE
        article_id = '" . $GLOBALS['plugin']->getSessionValue("article_id") . "' AND
        lang = '" . $GLOBALS['plugin']->getValue("save_lang") . "'
",__FILE__,__LINE__);

?>
