<?php
XT::call('saveNewsletter');
// Copy chapter
$result_chapter = XT::query("
    SELECT
        id,
        title,
        subtitle,
        link,
        maintext,
        image,
        image_version,
        level
    FROM
        " . XT::getTable("newsletter_chapters") . "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue('newsletter_id') . "  AND
        level = " . $GLOBALS['plugin']->getValue('level') . "
",__FILE__,__LINE__);

$row = $result_chapter->FetchRow();

// Insert new chapter
$chapter = $row;
XT::query("
    INSERT INTO
        " . XT::getTable('newsletter_chapters') . "
    (
        id,
        level,
        title,
        subtitle,
        link,
        maintext,
        image,
        image_version
    ) VALUES (
        '" . $GLOBALS['plugin']->getSessionValue('newsletter_id') . "',
        '" . ($GLOBALS['plugin']->getValue('maxlevel')+1) . "',
        '" . $chapter['title'] . "',
        '" . $chapter['subtitle'] . "',
        '" . $chapter['link'] . "',
        '" . $chapter['maintext'] . "',
        '" . $chapter['image'] . "',
        '" . $chapter['image_version'] . "'
    )
",__FILE__,__LINE__);


$GLOBALS['plugin']->setAdminModule("e");
?>