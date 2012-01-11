<?php

$tree = new XT_Tree("files_tree");
$job_node = $tree->addChildNode(XT::getConfig("application_main_node"));

// Neuer Eintrag erstellen
XT::query("
    INSERT INTO " . XT::getTable("jobs") . " (
        job_node,
        creation_date,
        creation_user
    ) VALUES (
        '" . $job_node . "',
        '" . TIME . "',
        '" . XT::getUserID() . "'
    )
",__FILE__,__LINE__);

// Die ID des neuen Eintrags abrufen
$result = XT::query("
    SELECT
        id
    FROM
        " . XT::getTable("jobs") . "
    ORDER BY
        id DESC
    LIMIT 1
",__FILE__,__LINE__);

$row = $result->fetchRow();

// Die neue ID zuweisen
XT::setValue("id", $row['id']);

XT::setAdminModule("editjob");

?>
