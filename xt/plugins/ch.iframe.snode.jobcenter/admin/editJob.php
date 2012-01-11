<?php

// Schema
$data['schematics'] = array("" => "");
foreach(glob(PLUGIN_DIR . "ch.iframe.snode.jobcenter/includes/application.*.schematic.config.inc.php") as $schematic_path) {
    $pattern = "/(.*?)application\.(.*?)\.schematic\.config\.inc\.php/";
    if(preg_match($pattern, $schematic_path, $matches)) {
        $data['schematics'][$matches[2]] = "application.{$matches[2]}.schematic.config.inc.php";
    }
}
ksort($data['schematics']);

// Template
$data['templates'] = array("" => "");
foreach (glob(TEMPLATE_DIR . 'default/ch.iframe.snode.jobcenter/application/*.tpl') as $template_path) {
    $pattern = "/(.*?)application\/(.*?)\.tpl/";
    if(preg_match($pattern, $template_path, $matches)) {
        $data['templates'][$matches[2]] = "{$matches[2]}.tpl";
    }
}
foreach (glob(TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.jobcenter/application/*.tpl') as $template_path) {
    $pattern = "/(.*?)application\/(.*?)\.tpl/";
    if(preg_match($pattern, $template_path, $matches)) {
        $data['templates'][$matches[2]] = "{$matches[2]}.tpl";
    }
}
ksort($data['templates']);

$result = XT::query("
    SELECT
        j.id,
        j.contact_id,
        j.location_id,
        j.job_id,
        j.job_percentage_from,
        j.job_percentage_to,
        j.job_start_at,
        j.job_end_at,
        j.application_up,
        j.application_schematic,
        j.application_template,
        jd.lang,
        jd.active,
        jd.title,
        jd.subtitle,
        jd.introduction,
        jd.maintext,
        a1.title as contact_title,
        a1.firstName as contact_firstName,
        a1.lastName as contact_lastName,
        a1.company as contact_company,
        a1.email as contact_email,
        a1.tel as contact_tel,
        a1.street as contact_street,
        a1.postalCode as contact_postalCode,
        a1.city as contact_city,
        c1.name as contact_country,
        a2.title as location_title,
        a2.firstName as location_firstName,
        a2.lastName as location_lastName,
        a2.company as location_company,
        a2.email as location_email,
        a2.tel as location_tel,
        a2.street as location_street,
        a2.postalCode as location_postalCode,
        a2.city as location_city,
        c2.name as location_country
    FROM
        " . XT::getTable('jobs') . " as j
    LEFT JOIN
        " . XT::getTable('jobs_detail') . " as jd ON (j.id = jd.id and jd.lang = '" . XT::getActiveLang() . "')
    LEFT JOIN
        " . XT::getTable('addresses') . " as a1 ON (j.contact_id = a1.id)
    LEFT JOIN
        " . XT::getTable('countries_detail') . " as c1 ON (a1.country = c1.country)
    LEFT JOIN
        " . XT::getTable('addresses') . " as a2 ON (j.location_id = a2.id)
    LEFT JOIN
        " . XT::getTable('countries_detail') . " as c2 ON (a2.country = c2.country)
    WHERE
        j.id = '" . XT::getValue("id") . "'
    LIMIT 1
",__FILE__,__LINE__);

$data['data'] = $result->fetchRow();

// Button
XT::addImageButton("Save", "saveJob" , "default", "disk_blue.png", "0" ,"slave1", "s");

XT::assign("EDIT", $data['data']);
XT::assign("SCHEMATICS", $data['schematics']);
XT::assign("TEMPLATES", $data['templates']);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", XT::getActiveLang());

// Address
XT::assign("ADDR_PICKER_TPL", XT::getConfig("ADDR_PICKER_TPL"));

$content = XT::build("editJob.tpl");

?>
