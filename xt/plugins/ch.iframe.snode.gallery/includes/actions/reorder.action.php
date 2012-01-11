<?php

if(XT::getSessionValue('open') > 0){
    
    
    
// remove non_images

    $result = XT::query("
        SELECT
            b.id,  b.type, a.active, a.source_folder_id, a.pos , a.lang
        FROM
            " . XT::getTable('galleries_rel') . " as a
        LEFT JOIN 
            " . XT::getTable('files') . " as b ON (b.id = a.file_id)             
        WHERE 
            a.gallery_id = '" . XT::getSessionValue('open') . "'
        AND
            a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        AND
            b.type !=1
            

    ",__FILE__,__LINE__);
    while($row = $result->FetchRow()){
        XT::query("DELETE from " . XT::getTable('galleries_rel') . " 
        WHERE
            gallery_id = '" . XT::getSessionValue('open') . "'
        AND
            lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        AND
            file_id=" . $row['id'], __FILE__,__LINE__,1);
    }
    
    
    $result = XT::query("
        SELECT
            gallery_id,file_id,lang
        FROM
            " . XT::getTable('galleries_rel') . "
        WHERE 
            gallery_id = '" . XT::getSessionValue('open') . "'
        AND
            lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        ORDER by
            pos ASC
    ",__FILE__,__LINE__);
    
    $i = 1;
    
    while($row = $result->FetchRow()){
        XT::query("
            UPDATE
                " . XT::getTable('galleries_rel') . "
            SET
                pos = " . $i . "
            WHERE 
                gallery_id = '" . XT::getSessionValue('open') . "'
            AND
                lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
            AND
                file_id =" . $row['file_id'] . "
            ",__FILE__,__LINE__);
        $i ++;
    }
    
    
    
}
?>