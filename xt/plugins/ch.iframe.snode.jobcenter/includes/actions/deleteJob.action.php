<?php

$job_id = intval(XT::getValue("id"));

if($job_id) {
    
    // Den Job nur loeschen, falls keine Bewerbungen vorhanden sind
    $result = XT::query("
        SELECT
            count(id) as count
        FROM
            " . XT::getTable("jobs_applications") . "
        WHERE
            job_id = '" . $job_id . "'
    ",__FILE__,__LINE__);
    
    $res = $result->fetchRow();
    if(intval($res['count']) == 0) {
        
        // Den Node auslesen
        $result = XT::query("
            SELECT
                job_node
            FROM
                " . XT::getTable("jobs") . "
            WHERE
                id = '" . $job_id . "'
            LIMIT 1
        ",__FILE__,__LINE__);
        
        $row = $result->fetchRow();
        $job_node = $row['job_node'];
        
        // Den Node loeschen
        $tree = new XT_Tree("files_tree");
        $tree->nodeDelete($job_node, true);
        
        // Den sprachunabhaengigen Teil loeschen
        XT::query("
            DELETE FROM
                " . XT::getTable("jobs") . "
            WHERE
                id = '" . $job_id . "'
        ",__FILE__,__LINE__);
        
        // Den sprachabhaengigen Teil loeschen
        XT::query("
            DELETE FROM
                " . XT::getTable("jobs_detail") . "
            WHERE
                id = '" . $job_id . "'
        ",__FILE__,__LINE__);
        
        // Allfallige Relations loeschen
        XT::query("
            DELETE FROM
                " . XT::getTable("relations") . "
            WHERE
                target_content_type = '" . XT::getBaseID() . "' AND
                target_content_id = '" . $job_id . "'
        ",__FILE__,__LINE__);
        
    }
    else {
        
        // Den Job in allen Sprachen deaktivieren
        XT::query("
            UPDATE
                " . XT::getTable("jobs_detail") . "
            SET
                active = 0
            WHERE
                id = '" . $job_id . "'
        ",__FILE__,__LINE__);
        
        XT::log(XT::translate("There are still applications who need this job, deactivated instead"),__FILE__,__LINE__,XT_ERROR);
    }
}

?>