<?php

// Insert article
XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable("faq") . "
(
    views
) VALUES (
    0
)",__FILE__,__LINE__);

// get new id
$result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable("faq") . " ORDER BY id DESC",__FILE__,__LINE__);
$data = XT::getQueryData($result);
$newid = $data[0]['id'];

// Add default language version
XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable("faq_details") . "
(
    article_id,
    title,
    creation_date,
    creation_user,
    lang
) VALUES (
    " . $newid . ",
    '" . $GLOBALS['lang']->msg("New article") . "',
    " . time() . ",
    " . XT::getUserID() . ",
    '" . $GLOBALS['plugin']->getActiveLang() . "'
)",__FILE__,__LINE__);

// Add relation
XT::query("
    INSERT INTO " . $GLOBALS['plugin']->getTable("faq_rel") . " 
    (
        node_id,
        article_id
    ) VALUES (
        " . $GLOBALS['plugin']->getSessionValue("open") . ",
        " . $newid . "
    )
",__FILE__,__LINE__);

$GLOBALS['plugin']->setValue("article_id", $newid);
$GLOBALS['plugin']->setAdminModule('ea');
?>