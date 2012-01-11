<?php

// Get file details
$result = XT::query("
    SELECT
        a.id,
        det.title,
        det.description
    FROM
        " . XT::getDatabasePrefix() . "files as a
    LEFT JOIN
        " . XT::getDatabasePrefix() . "files_details as det ON (det.id = a.id AND det.lang = '" . XT::getPluginLang() . "')
        
    WHERE
        a.id = '" . XT::getValue('file') . "'
",__FILE__,__LINE__);

$files = array();
while($row = $result->FetchRow()){
    $files[] = $row;
}

$file = $files[0];

// Get highest pos value
$result = XT::query("
    SELECT
        pos
    FROM 
        " . XT::getTable('galleries_rel') . "
    WHERE
        gallery_id = " . XT::getSessionValue('open') . "
    ORDER BY 
        pos DESC
    LIMIT 1
",__FILE__,__LINE__);

$pos = 1;
while($row = $result->FetchRow()){
    $pos = $row['pos']+1;
}

XT::query("
    INSERT INTO
        " . XT::getTable('galleries_rel') . "
    (
        gallery_id,
        file_id,
        lang,
        title,
        description,
        source_folder_id,
        pos
    ) VALUES (
        '" . XT::getSessionValue('open') . "',
        '" . $file['id'] . "',
        '" . $GLOBALS['plugin']->getActiveLang() . "',
        '',
        '',
        '" . XT::getValue('folder') . "',
        '" . $pos . "'
    )
",__FILE__,__LINE__);

// Delete and insert new folder entry
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