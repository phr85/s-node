<?php

$tree = new XT_Tree("files_tree");
$job_node = $tree->addChildNode(XT::getConfig("application_main_node"));

$old_job_id = XT::getValue("id");

// Hauptinformationen abrufen
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable("jobs") . "
    WHERE
        id = '" . $old_job_id . "'
    LIMIT 1
",__FILE__,__LINE__);

$row = $result->FetchRow();

// Den Haupteintrag kopieren
XT::query("
    INSERT INTO " . XT::getTable("jobs") . " (
        job_node,
        creation_date,
        creation_user,
        contact_id,
        location_id,
        job_id,
        job_percentage_from,
        job_percentage_to,
        job_start_at,
        job_end_at,
        application_up,
        application_schematic,
        application_template
    ) VALUES (
        '" . $job_node . "',
        '" . TIME . "',
        '" . XT::getUserID() . "',
        '" . addslashes($row['contact_id']) . "',
        '" . addslashes($row['location_id']) . "',
        '" . addslashes($row['job_id']) . "',
        '" . addslashes($row['job_percentage_from']) . "',
        '" . addslashes($row['job_percentage_to']) . "',
        '" . addslashes($row['job_start_at']) . "',
        '" . addslashes($row['job_end_at']) . "',
        '" . addslashes($row['application_up']) . "',
        '" . addslashes($row['application_schematic']) . "',
        '" . addslashes($row['application_template']) . "'
    )
",__FILE__,__LINE__);

// Die ID des aktuellen Eintrages abrufen
$result = XT::query("
    SELECT
        id
    FROM
        " . XT::getTable("jobs") . "
    WHERE
        contact_id = '" . addslashes($row['contact_id']) . "' AND
        location_id = '" . addslashes($row['location_id']) . "' AND
        job_id = '" . addslashes($row['job_id']) . "' AND
        job_percentage_from = '" . addslashes($row['job_percentage_from']) . "' AND
        job_percentage_to = '" . addslashes($row['job_percentage_to']) . "' AND
        job_start_at = '" . addslashes($row['job_start_at']) . "' AND
        job_end_at = '" . addslashes($row['job_end_at']) . "' AND
        application_up = '" . addslashes($row['application_up']) . "'
    ORDER BY
        id DESC
    LIMIT 1
",__FILE__,__LINE__);

$row = $result->FetchRow();
$job_id = addslashes($row['id']);


// Detailinformationen abrufen
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable("jobs_detail") . "
    WHERE
        id = '" . $old_job_id . "'
",__FILE__,__LINE__);

// Detailinformationen kopieren
while($row = $result->FetchRow()) {

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
            '" . addslashes($row['lang']) . "',
            '" . 0 . "',
            '" . XT::translate("Copy") . ": " . addslashes($row['title']) . "',
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
            '" . addslashes($row['lang']) . "',
            '" . TIME . "',
            '" . XT::getUserID() . "',
            '" . XT::translate("Copy") . ": " . addslashes($row['title']) . "',
            1,
            1,
            0
        )
    ",__FILE__,__LINE__);

}

// Die Relations auslesen
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable("relations") . "
    WHERE
        target_content_type = '" . XT::getBaseID() ."' AND
        target_content_id = '" . $old_job_id. "'
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
            '" . addslashes($row['lang']) . "',
            '" . addslashes($row['content_id']) . "',
            '" . addslashes($row['content_type']) . "',
            '" . addslashes($row['target_content_type']) . "',
            '" . $job_id. "',
            '" . addslashes($row['title']) . "',
            '" . addslashes($row['target_title']) . "',
            '" . addslashes($row['position']) . "'
        )
    ",__FILE__,__LINE__);
}

?>