<?php

$GLOBALS['plugin']->call('saveArticle');

require_once(CLASS_DIR . "chapter.class.php");

    $result = XT::query("
        SELECT 
            MAX(level) as level 
        FROM 
            " . XT::getTable('articles_chapters_v') . " 
        WHERE 
            id =" . $GLOBALS['plugin']->getSessionValue('id') . " AND
            lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND
            rid = " . $GLOBALS['plugin']->getValue('rid') . "
    ",__FILE__,__LINE__);
    if($result){
        $row = $result->FetchRow();
        $maxlevel = $row['level'];
    }

// Insert new chapter as new revision
XT::query("
    INSERT INTO 
        " . XT::getTable('articles_chapters_v') . " 
    (
        id, 
        level, 
        active,
        rid,
        lang
    ) VALUES (
        " . $GLOBALS['plugin']->getSessionValue('id') . ", 
        " . ($maxlevel+1) . ", 
        1" . ",
        " . $GLOBALS['plugin']->getValue('rid') . ",
        '" . $GLOBALS['plugin']->getActiveLang() . "'
    )
",__FILE__,__LINE__);

/*
// Insert placeholder into live system
XT::query("
    INSERT INTO 
        " . XT::getTable('articles_chapters') . " 
    (
        id, 
        level, 
        active
    ) VALUES (
        " . $GLOBALS['plugin']->getSessionValue('id') . ", 
        " . ($maxlevel+1) . ", 
        0" . "
    )
",__FILE__,__LINE__);
*/

$GLOBALS['plugin']->setAdminModule("e");
?>