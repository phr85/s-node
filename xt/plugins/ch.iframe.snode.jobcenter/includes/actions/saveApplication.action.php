<?php

$application_id = XT::getValue("id");
$application = XT::getValue("application");

// Die Bewerbung aktualisieren
XT::query("
    UPDATE
        " . XT::getTable("jobs_applications") . "
    SET
        modification_date = '" . TIME ."',
        modification_user = '" . XT::getUserID() . "'
    WHERE
        id = " . $application_id . "
",__FILE__,__LINE__);

// Alle Eingaben aktualisieren
foreach($application['values'] as $field_id => $value) {
    
    // Die Werte aktualisieren
    XT::query("
        UPDATE
            " . XT::getTable("jobs_applications_values") . "
        SET
            value = '" . strip_tags($value) ."'
        WHERE
            id = " . $field_id ."
    ",__FILE__,__LINE__);
    
}

?>