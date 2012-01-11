<?php

// Values
$job = XT::getValue("job");
$job_id = XT::getValue("id");

// job_start_at in einen timestamp umwandeln
if(preg_match_all("|\.|", $job['job_start_at_str'], $res = array()) == 2) {
    $job_start_at_array = explode(".", $job['job_start_at_str']);
    $job_start_at = mktime(0, 0, 0, $job_start_at_array[1], $job_start_at_array[0], $job_start_at_array[2]);
}
else {
    $job_start_at = 0;
}

// job_end_at in einen timestamp umwandeln
if(preg_match_all("|\.|", $job['job_end_at_str'], $res = array()) == 2) {
    $job_end_at_array = explode(".", $job['job_end_at_str']);
    $job_end_at = mktime(0, 0, 0, $job_end_at_array[1], $job_end_at_array[0], $job_end_at_array[2]);
}
else {
    $job_end_at = 0;
}

// application_up in einen timestamp umwandeln
if(preg_match_all("|\.|", $job['application_up_str'], $res = array()) == 2) {
    $application_up_array = explode(".", $job['application_up_str']);
    $application_up = mktime(0, 0, 0, $application_up_array[1], $application_up_array[0], $application_up_array[2]);
}
else {
    $application_up = 0;
}

// Die Hauptdaten aktualisieren
XT::query("
    UPDATE
        " . XT::getTable("jobs") . "
    SET
        mod_date = '" . TIME . "',
        mod_user = '" . XT::getUserID() . "',
        contact_id = '" . $job['contact_id'] . "',
        location_id = '" . $job['location_id'] . "',
        job_id = '" . $job['job_id'] . "',
        job_percentage_from = '" . $job['job_percentage_from'] . "',
        job_percentage_to = '" . $job['job_percentage_to'] . "',
        job_start_at = '" . $job_start_at . "',
        job_end_at = '" . $job_end_at . "',
        application_up = '" . $application_up . "',
        application_schematic = '" . $job['application_schematic'] . "',
        application_template = '" . $job['application_template'] . "'
    WHERE
        id = '" . $job_id ."'
",__FILE__,__LINE__);

// Details erstellen bzw.aktualisieren
$result = XT::query("
    SELECT
        id
    FROM
        " . XT::getTable("jobs_detail") . "
    WHERE
        id = '" . $job_id ."' AND
        lang = '" . XT::getActiveLang() . "'
",__FILE__,__LINE__);

$row = $result->fetchRow();
$article_id_from_det = intval($row['id']);

// Bewerbungsnode abrufen
$result = XT::query("
    SELECT
        job_node
    FROM
        " . XT::getTable("jobs") . "
    WHERE
        id = '" . $job_id ."'
",__FILE__,__LINE__);

$row = $result->fetchRow();
$job_node = intval($row['job_node']);

// Falls es die Details in dieser Sprache noch nicht gibt die Details erstellen
if($article_id_from_det == 0) {
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
            '" . XT::getActiveLang() . "',
            '" . 0 . "',
            '" . $job['title'] . "',
            '" . $job['subtitle'] . "',
            '" . $job['introduction'] . "',
            '" . $job['maintext'] . "'
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
            '" . XT::getActiveLang() . "',
            '" . TIME . "',
            '" . XT::getUserID() . "',
            '" . $job['title'] . "',
            1,
            1,
            0
        )
    ",__FILE__,__LINE__);
}
else {
    XT::query("
        UPDATE
            " . XT::getTable("jobs_detail") . "
        SET
            mod_date = '" . TIME . "',
            mod_user = '" . XT::getUserID() . "',
            title = '" . $job['title'] . "',
            subtitle = '" . $job['subtitle'] . "',
            introduction = '" . $job['introduction'] . "',
            maintext = '" . $job['maintext'] . "'
        WHERE
            id = '" . $job_id ."' AND
            lang = '" . XT::getActiveLang() . "'
    ",__FILE__,__LINE__);
    // Den Titel des Nodes updaten
    XT::query("
        UPDATE
            " . XT::getTable("files_tree_details") . "
        SET
            title = '" . $job['title'] . "'
        WHERE
            node_id = '" . $job_node ."' AND
            lang = '" . XT::getActiveLang() . "'
    ",__FILE__,__LINE__);
}

$GLOBALS['plugin']->setAdminModule("editjob");

?>