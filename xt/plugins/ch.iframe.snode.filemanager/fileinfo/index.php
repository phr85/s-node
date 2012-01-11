<?php

// Parameter :: file_id
$file_id = XT::autoval("id","P",1);

// Parameter :: style
$style = XT::getParam("style") != '' ? XT::getParam("style") : 'default.tpl';

$data = array();

if(is_numeric($file_id)){
    
    // Get files for the active folder
    $result = XT::query("
        SELECT
            det.*,
            f.*
        FROM
            " . XT::getTable("files") . " as f
        LEFT JOIN
            " . XT::getTable("files_details") . " as det ON (f.id = det.id AND det.lang = '" . XT::getLang() .  "')
        WHERE
            f.id = " . $file_id . "
        LIMIT 1
    ",__FILE__,__LINE__);
    
    $data['data'] = $result->fetchRow();

    // versionsinformationen
    $result = XT::query("
        SELECT
            *
        FROM
            " . XT::getTable("files_revision") . "
        WHERE
            file_id = " . $file_id . "
        ORDER BY
            revision DESC
    " ,__FILE__,__LINE__);
    
    $data['revision'] = XT::getQueryData($result);

}

XT::assign("xt" . XT::getBaseID() . "_fileinfo", $data);
$content = XT::build($style);

?>