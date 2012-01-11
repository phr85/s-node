<?php

$GLOBALS['plugin']->call('saveNews');

require_once(CLASS_DIR . "chapter.class.php");

// Adds a chapter
$maxlevel = $GLOBALS['plugin']->getValue('maxlevel');

if($maxlevel == 0){
    $result = XT::query("
        SELECT 
            MAX(level) as level 
        FROM 
            " . XT::getTable('newsmanager_chapters_v') . " 
        WHERE 
            id =" . $GLOBALS['plugin']->getSessionValue('id') . " AND
            lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    ",__FILE__,__LINE__);
    if($result){
        $row = $result->FetchRow();
        $maxlevel = $row['level'];
    }
}

// Insert new chapter as new revision
XT::query("
    INSERT INTO 
        " . XT::getTable('newsmanager_chapters_v') . " 
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
        " . XT::getTable('newsmanager_chapters') . " 
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