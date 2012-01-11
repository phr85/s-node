<?php

XT::call('saveNewsletter');
 
// Adds a chapter
$maxlevel = XT::getValue('maxlevel');

if($maxlevel == 0){
    $result = XT::query("
        SELECT 
            MAX(level) as level 
        FROM 
            " . XT::getTable('newsletter_chapters') . " 
        WHERE 
            id =" . XT::getValue('newsletter_id') ,__FILE__,__LINE__);
    if($result){
        $row = $result->FetchRow();
        $maxlevel = $row['level'];
    }
}

// Insert new chapter as new revision
XT::query("
    INSERT INTO 
        " . XT::getTable('newsletter_chapters') . " 
    (
        id, 
        level
    ) VALUES (
        " . XT::getValue('newsletter_id') . ", 
        " . ($maxlevel+1) . "
    )
",__FILE__,__LINE__);

?>