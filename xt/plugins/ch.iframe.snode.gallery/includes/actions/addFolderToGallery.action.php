<?php

// Get folders
$result = XT::query("
    SELECT
        a.id
    FROM
        " . XT::getDatabasePrefix() . "files_tree as a, 
        " . XT::getDatabasePrefix() . "files_tree as b
    WHERE
        b.id = '" . XT::getValue('folder') . "' AND
        a.l >= b.l AND a.r <= b.r
",__FILE__,__LINE__);

$folders = array();
while($row = $result->FetchRow()){
    $folders[] = $row['id'];
}

// Get folder contents
$result = XT::query("
    SELECT
        c.id,
        det.title,
        det.description,
        rel.node_id
    FROM
        " . XT::getDatabasePrefix() . "files_rel as rel 
    LEFT JOIN 
        " . XT::getDatabasePrefix() . "files as c ON (c.id = rel.file_id)
    LEFT JOIN
        " . XT::getDatabasePrefix() . "files_details as det ON (det.id = rel.file_id AND det.lang = '" . XT::getPluginLang() . "')
    WHERE
        rel.node_id IN (" . implode(',',$folders)  . ") AND (c.type=1 OR c.type=2 OR c.type=3)
",__FILE__,__LINE__);

$files = array();
while($row = $result->FetchRow()){
    $files[] = $row;
}

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

// Add files to the gallery
foreach($files as $file){
    $GLOBALS['db']->query("
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
            '" . $file['node_id'] . "',
            '" . $pos . "'
        )
    ");
    
    $pos++;
}

// Add folders to the gallery
foreach($folders as $folder_id){
    $GLOBALS['db']->query("
        INSERT INTO
            " . XT::getTable('galleries_folder_rel') . "
        (
            gallery_id,
            folder_id,
            lang,
            full
        ) VALUES (
            '" . XT::getSessionValue('open') . "',
            '" . $folder_id . "',
            '" . $GLOBALS['plugin']->getActiveLang() . "',
            1
        )
    ");
}

XT::setAdminModule('ai');

?>