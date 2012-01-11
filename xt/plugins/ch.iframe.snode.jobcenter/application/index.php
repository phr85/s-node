<?php

$data = array();

// Parameter
$data['param']['job_id'] = XT::autoval("job_id", "R", 0);

// Daten des Jobs abrufen
$result = XT::query("
    SELECT
        job.application_schematic,
        job.application_template
    FROM
        " . XT::getTable("jobs") . " as job
    INNER JOIN
        " . XT::getTable("jobs_detail") . " as det on (job.id = det.id AND det.active = 1 AND det.lang = '" . XT::getLang() . "')
    WHERE
        job.id = {$data['param']['job_id']}
    LIMIT 1
",__FILE__,__LINE__);

$data['job'] = $result->fetchRow();

// Nur falls der Job aktiv ist und ein Schema gewaehlt ist etwas darstellen
if($data['job']['application_schematic'] != "") {
    
    // Schema
    $data['param']['schematic'] = $data['job']['application_schematic'];
    
    // Style
    if($res['application_template'] != "") {
        $data['param']['style'] = $data['job']['application_template'];
    }
    else {
        $data['param']['style'] = "default.tpl";
    }
    $data['param']['style_folder'] = str_replace(".tpl", "", $data['param']['style']);
    
    //  Konfiguration laden
    require_once(PLUGIN_DIR . "ch.iframe.snode.jobcenter/includes/application." . $data['param']['schematic'] . ".schematic.config.inc.php");
    $data['config']['fieldtypes'] = $fieldtypes;
    $data['form'] = $schematic;
    
    // Einen linearen Array generieren
    $data['form']['fields'] = array();
    foreach($data['form']['field_groups'] as $field_group) {
        foreach($field_group['fields'] as $field) {
            $data['form']['fields'][$field['label']] = $field;
        }
    }
    
    // Das Formular verarbeiten
    if(isset($_POST['application'])) {
        require_once(PLUGIN_DIR . "ch.iframe.snode.jobcenter/application/perform.php");
    }
    
    XT::assign("xt" . XT::getBaseID() . "_application", $data);
    
    $content = XT::build($data['param']['style']);
}

?>