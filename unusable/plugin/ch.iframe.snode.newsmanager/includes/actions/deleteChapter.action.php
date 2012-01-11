<?php
$GLOBALS['plugin']->call("saveNews");

// Delete a chapter
$result = XT::query("
    DELETE FROM 
        " . XT::getTable('newsmanager_chapters_v') . " 
    WHERE 
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND 
        level= " . $GLOBALS['plugin']->getValue('level') . " AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'"
,__FILE__,__LINE__);
          
// Set chapterlevel in the right order
$result = XT::query("
    UPDATE 
        " . XT::getTable('newsmanager_chapters_v') . " 
    SET 
        level = (level-1) 
    WHERE 
        level > " . $GLOBALS['plugin']->getValue('level') . " AND 
        id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "' 
        ORDER by level asc"
,__FILE__,__LINE__);
 
$GLOBALS['plugin']->setAdminModule("e");
?>