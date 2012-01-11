<?php
$GLOBALS['plugin']->call("saveNewsletter");

// Delete a chapter
$result = XT::query("
    DELETE FROM 
        " . XT::getTable('newsletter_chapters') . " 
    WHERE 
        id = " . XT::getValue("newsletter_id") . " AND 
        level= " . XT::getValue('level'),__FILE__,__LINE__);
          
// Set chapterlevel in the right order
$result = XT::query("
    UPDATE 
        " . XT::getTable('newsletter_chapters') . " 
    SET 
        level = (level-1) 
    WHERE 
        level > " . XT::getValue('level') . " AND 
        id = " . XT::getValue("newsletter_id") . "
        ORDER by level asc"
,__FILE__,__LINE__);
 
?>