<?php

$job_id = XT::getValue("id");

// Abklaeren ob es den Artikel in dieser Sprache schon gibt
$result = XT::query("
    SELECT
        id
    FROM
        " . XT::getTable("jobs_detail") . "
    WHERE
        id = '" . $job_id . "' AND
        lang = '" . XT::getValue("copyToLang") . "'
    LIMIT 1
",__FILE__,__LINE__);

$row = $result->FetchRow();
$article_id_from_det = intval($row['id']);

// Bewerbungsnode abrufen
$result = XT::query("
    SELECT
        job_node
    FROM
        " . XT::getTable("jobs") . "
    WHERE
        id = '" . $job_id. "'
",__FILE__,__LINE__);

$row = $result->fetchRow();
$job_node = intval($row['job_node']);

if($article_id_from_det == 0) {
    
    $result = XT::query("
        SELECT
            *
        FROM
            " . XT::getTable("jobs_detail") . "
        WHERE
            id = '" . $job_id . "' AND
            lang = '" . XT::getActiveLang() . "'
        LIMIT 1
    ",__FILE__,__LINE__);
    
    $row = $result->FetchRow();

    XT::query("
        INSERT INTO " . XT::getTable("jobs_detail") . " (
            id,
            creation_date,
            creation_user,
            lang,
            active,
            title,
            subtitle,
            introduction,
            maintext
        ) VALUES (
            '" . $job_id . "',
            '" . TIME . "',
            '" . XT::getUserID() . "',
            '" . XT::getValue("copyToLang") . "',
            '" . 0 . "',
            '" . addslashes($row['title']) . "',
            '" . addslashes($row['subtitle']) . "',
            '" . addslashes($row['introduction']) . "',
            '" . addslashes($row['maintext']) . "'
        )
    ",__FILE__,__LINE__);
    
    // Den Node fuer die Bewerbung mit einem Titel versehen
    XT::query("
        INSERT INTO " . XT::getTable("files_tree_details") . " (
            node_id,
            lang,
            creation_date,
            creation_user,
            title,
            active,
            isFolder,
            public
        ) VALUES (
            '" . $job_node . "',
            '" . XT::getValue("copyToLang") . "',
            '" . TIME . "',
            '" . XT::getUserID() . "',
            '" . addslashes($row['title']) . "',
            1,
            1,
            0
        )
    ",__FILE__,__LINE__);
    
    // Die Relations auslesen
    $result = XT::query("
        SELECT
            *
        FROM
            " . XT::getTable("relations") . "
        WHERE
            target_content_type = '" . XT::getBaseID() ."' AND
            target_content_id = '" . $job_id. "' AND
            lang = '" . XT::getActiveLang() . "'
    ",__FILE__,__LINE__);
    
    // Die Relations eintragen
    while($row = $result->fetchRow()) {
        
        XT::query("
            INSERT INTO " . XT::getTable("relations") . " (
                lang,
                content_id,
                content_type,
                target_content_type,
                target_content_id,
                title,
                target_title,
                position
            ) VALUES (
                '" . XT::getValue("copyToLang") . "',
                '" . addslashes($row['content_id']) . "',
                '" . addslashes($row['content_type']) . "',
                '" . addslashes($row['target_content_type']) . "',
                '" . addslashes($row['target_content_id']) . "',
                '" . addslashes($row['title']) . "',
                '" . addslashes($row['target_title']) . "',
                '" . addslashes($row['position']) . "'
            )
        ",__FILE__,__LINE__);
    }
    
    XT::setValue('lang_filter', XT::getValue('copyToLang'));
    XT::setSessionValue('lang_filter', XT::getValue('copyToLang'));

}
else{
    XT::log(XT::translate("Job already exists int this language"),__FILE__,__LINE__,XT_WARNING);
}

XT::setAdminModule('editjob');

?>