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

// Delete folder and file entries
foreach($folders as $folder_id){
    XT::query("
        DELETE FROM
            " . XT::getTable('galleries_folder_rel') . "
        WHERE
            folder_id = '" . $folder_id . "'
            AND gallery_id = '" . XT::getSessionValue('open') . "'
    ",__FILE__,__LINE__);
    
    XT::query("
        DELETE FROM
            " . XT::getTable('galleries_rel') . "
        WHERE
            source_folder_id = '" . $folder_id . "'
            AND gallery_id = '" . XT::getSessionValue('open') . "'
    ",__FILE__,__LINE__);
}

XT::setAdminModule('ai');

?>