<?php

// Copy chapter
$result_chapter = XT::query("
    SELECT
        id,
        title,
        subtitle,
        maintext,
        image,
        image_version,
        image_link,
        image_link_target,
        image_zoom,
        active,
        level,
        lang,
        layout
    FROM
        " . XT::getTable("articles_chapters_v") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
        rid = " . $GLOBALS['plugin']->getValue('rid') . " AND
        level = " . $GLOBALS['plugin']->getValue('level') . " AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);

$row = $result_chapter->FetchRow();

// Insert new chapter
$chapter = $row;
XT::query("
    INSERT INTO
        " . XT::getTable('articles_chapters_v') . "
    (
        id,
        level,
        title,
        subtitle,
        maintext,
        image,
        image_version,
        image_link,
        image_link_target,
        image_zoom,
        active,
        rid,
        lang,
        layout
    ) VALUES (
        '" . $GLOBALS['plugin']->getSessionValue('id') . "',
        '" . ($GLOBALS['plugin']->getValue('maxlevel')+1) . "',
        '" . addslashes($chapter['title']) . "',
        '" . addslashes($chapter['subtitle']) . "',
        '" . addslashes($chapter['maintext']) . "',
        '" . $chapter['image'] . "',
        '" . $chapter['image_version'] . "',
        '" . $chapter['image_link'] . "',
        '" . $chapter['image_link_target'] . "',
        '" . $chapter['image_zoom'] . "',
        1,
        '" . $GLOBALS['plugin']->getValue('rid') . "',
        '" . $chapter['lang'] . "',
        '" . $chapter['layout'] . "'
    )
",__FILE__,__LINE__);


$GLOBALS['plugin']->setAdminModule("e");
?>