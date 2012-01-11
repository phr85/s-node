<?php

$application_id = intval(XT::getValue("id"));

if($application_id) {
    
    // Den Node mit den Dateien auslesen
    $result = XT::query("
        SELECT
            application_node
        FROM
            " . XT::getTable("jobs_applications") . "
        WHERE
            id = {$application_id}
    ",__FILE__,__LINE__);
    
    $row = $result->fetchRow();
    $application_node = $row['application_node'];
    
    // Alle Anhaenge auslesen
    $result = XT::query("
        SELECT
            file_id
        FROM
            " . XT::getTable("files_rel") . "
        WHERE
            node_id = {$application_node}
    ",__FILE__,__LINE__);
    
    // Jede Datei loeschen
    while($row = $result->fetchRow()) {
        
        XT::query("
            DELETE
            FROM
                " . XT::getTable("files") . "
            WHERE
                id = {$row['file_id']}
        ",__FILE__,__LINE__);
        
        XT::query("
            DELETE
            FROM
                " . XT::getTable("files_details") . "
            WHERE
                id = {$row['file_id']}
        ",__FILE__,__LINE__);
        
        XT::query("
            DELETE
            FROM
                " . XT::getTable("files_rel") . "
            WHERE
                file_id = {$row['file_id']}
        ",__FILE__,__LINE__);
        
        // Bild loeschen
        unlink(DATA_DIR . "files/{$row['file_id']}");
        
    }
    
    // Den Node loeschen
    $tree = new XT_Tree("files_tree");
    $tree->nodeDelete($application_node, true);
    
    // Die Bewerbung loeschen
    XT::query("
        DELETE
        FROM
            " . XT::getTable("jobs_applications") . "
        WHERE
            id = {$application_id}
    ",__FILE__,__LINE__);
    
    // Die Felder der Bewerbung loeschen
    XT::query("
        DELETE
        FROM
            " . XT::getTable("jobs_applications_values") . "
        WHERE
            application_id = {$application_id}
    ",__FILE__,__LINE__);

}

?>