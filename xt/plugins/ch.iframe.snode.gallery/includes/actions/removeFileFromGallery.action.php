<?php

// Find out actual position
if(XT::getValue('pos') <= 0){
    $result = XT::query("
        SELECT
            pos
        FROM
            " . XT::getTable('galleries_rel') . "
        WHERE 
            file_id = '" . XT::getValue('file'). "' AND 
            gallery_id = '" . XT::getSessionValue('open') . "'
        LIMIT 1
    ",__FILE__,__LINE__);

    while($row = $result->FetchRow()){
        XT::setValue('pos', $row['pos']);
    }
}

// Delete and insert new folder entry
XT::query("
    DELETE FROM
        " . XT::getTable('galleries_rel') . "
    WHERE
        gallery_id = '" . XT::getSessionValue('open') . "' AND
        file_id = '" . XT::getValue('file') . "' AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);

// Update positions
XT::query("
    UPDATE
        " . XT::getTable('galleries_rel') . "
    SET
        pos = pos - 1
    WHERE 
        pos > " . XT::getValue('pos') . "
",__FILE__,__LINE__);

XT::query("
    DELETE FROM
        " . XT::getTable('galleries_folder_rel') . "
    WHERE
        gallery_id = '" . XT::getSessionValue('open') . "' AND
        folder_id = '" . XT::getValue('folder') . "' AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);

XT::query("
    INSERT INTO
        " . XT::getTable('galleries_folder_rel') . "
    (
        gallery_id,
        folder_id,
        lang,
        full
    ) VALUES (
        '" . XT::getSessionValue('open') . "',
        '" . XT::getValue('folder') . "',
        '" . $GLOBALS['plugin']->getActiveLang() . "',
        0
    )
",__FILE__,__LINE__);

?>