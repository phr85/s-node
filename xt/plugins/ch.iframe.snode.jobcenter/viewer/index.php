<?php

$data = array();

// Request :: job_id
$data['param']['job_id'] = XT::autoval("job_id", "R");

// Parameter :: style
$data['param']['style'] = XT::autoval("style", "P", "default.tpl");

// Paramter :: application_tpl
$data['param']['application_tpl'] = XT::autoval("application_tpl", "P");

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
        jd.title,
        jd.subtitle,
        jd.introduction,
        jd.maintext,
        a1.title as contact_title,
        a1.firstName as contact_first_name,
        a1.lastName as contact_last_name,
        a1.position as contact_position,
        a1.email as contact_email,
        a1.tel as contact_tel,
        a1.fax as contact_fax,
        a1.street as contact_street,
        a1.postalCode as contact_postal_code,
        a1.city as contact_city,
        c1.name as contact_country,
        a2.title as location_title,
        a2.firstName as location_first_name,
        a2.lastName as location_last_name,
        a2.email as location_email,
        a2.tel as location_tel,
        a2.fax as location_fax,
        a2.street as location_street,
        a2.postalCode as location_postal_code,
        a2.city as location_city,
        c2.name as location_country,
        cat.title as cat_title
    FROM
        " . XT::getTable('jobs') . " as j
    INNER JOIN
        " . XT::getTable('jobs_detail') . " as jd ON (j.id = jd.id and jd.lang = '" . XT::getLang() . "')
    LEFT JOIN
        " . XT::getTable('addresses') . " as a1 ON (j.contact_id = a1.id)
    LEFT JOIN
        " . XT::getTable('countries_detail') . " as c1 ON (a1.country = c1.country)
    LEFT JOIN
        " . XT::getTable('addresses') . " as a2 ON (j.location_id = a2.id)
    LEFT JOIN
        " . XT::getTable('countries_detail') . " as c2 ON (a2.country = c2.country)
    LEFT JOIN
        " . XT::getTable('relations') . " as rel ON (rel.target_content_id = j.id AND rel.target_content_type = " . XT::getBaseID() . " AND content_type = 5500)
    LEFT JOIN
        " . XT::getTable('category_nodes') . " as cat ON (rel.content_id = cat.node_id AND cat.lang = '" . XT::getLang() . "')
    WHERE
        j.id = '" . $data['param']['job_id'] . "' AND
        jd.active = 1
    GROUP BY
        j.id
    ORDER BY
        rel.position
",__FILE__,__LINE__);

$data['data'] = $result->fetchRow();
XT::assign("xt" . XT::getBaseID() . "_viewer", $data);

$content = XT::build($data['param']['style']);

?>