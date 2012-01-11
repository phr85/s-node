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
        lang 
    FROM 
        " . XT::getTable("newsmanager_chapters_v") . "
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
        " . XT::getTable('newsmanager_chapters_v') . "
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
        lang
    ) VALUES (
        '" . $GLOBALS['plugin']->getSessionValue('id') . "', 
        '" . ($GLOBALS['plugin']->getValue('maxlevel')+1) . "',
        '" . $chapter['title'] . "',
        '" . $chapter['subtitle'] . "',
        '" . $chapter['maintext'] . "',
        '" . $chapter['image'] . "',
        '" . $chapter['image_version'] . "',
        '" . $chapter['image_link'] . "',
        '" . $chapter['image_link_target'] . "',
        '" . $chapter['image_zoom'] . "',
        1,
        '" . $GLOBALS['plugin']->getValue('rid') . "',
        '" . $GLOBALS['plugin']->getActiveLang() . "'
    )
",__FILE__,__LINE__);
    

$GLOBALS['plugin']->setAdminModule("e");
?>