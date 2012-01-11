<?php

$data = array();

// Parameter :: style
$data['param']['style'] = XT::autoval("style", "P", "default.tpl");

// Request :: categories
$data['param']['categories'] = XT::autoval("categories","R", 1);

// Parameter :: orderByCategoryPosition
$data['param']['order_cat_position'] = XT::autoval("order_cat_position", "P", "true");

// Request :: cities
$data['param']['cities'] = XT::autoval("cities","R");
$cities_sql = "";
if(!empty($data['param']['cities'])) {
    $cities = explode(",", $data['param']['cities']);
    $cities_sql = " AND a.city IN('" . implode("','", $cities) . "') ";
}

// Parameter :: details_tpl
$data['param']['details_tpl'] = XT::autoval("details_tpl", "P");

// Parameter :: count
$data['param']['count'] = XT::autoval("count", "P", 20);

// Sortierung
$searchparams = "jd.title,a.city,j.job_percentage_from,j.job_percentage_to";

$data['metadata']['sort'] = explode(",", $searchparams);

XT::loadClass("ordering.class.php","ch.iframe.snode.core");
$order = new XT_Order($searchparams,"jd.title",1,"default");
$order->setListener("sort","sortby");

if(!empty($data['param']['categories'])) {
    
    // Die Jobs abrufen
    $result = XT::query("
        SELECT
            j.id,
            j.contact_id,
            j.location_id,
            j.job_id,
            j.job_percentage_from,
            j.job_percentage_to,
            jd.active,
            jd.title,
            jd.subtitle,
            jd.introduction,
            a.city as location_city,
            cat.title as cat_title
        FROM
            " . XT::getTable("relations") . " as rel
        INNER JOIN
            " . XT::getTable('jobs') . " as j ON (rel.target_content_id = j.id)
        INNER JOIN
            " . XT::getTable('jobs_detail') . " as jd ON (j.id = jd.id and jd.lang = '" . XT::getLang() . "')
        LEFT JOIN
            " . XT::getTable('addresses') . " as a ON (j.location_id = a.id)
        LEFT JOIN
            " . XT::getTable('category_nodes') . " as cat ON (rel.content_id = cat.node_id AND cat.lang = '" . XT::getLang() . "')
        WHERE
            rel.content_type = 5500 AND
            rel.target_content_type=" . XT::getBaseID() . " AND
            rel.content_id in(" . $data['param']['categories'] . ") AND
            jd.active = 1
            " . $cities_sql . "
        GROUP BY
            j.id
            " . $order->get() . "
        LIMIT
            " . $data['param']['count'] . "
    ",__FILE__,__LINE__);
    
    // Sortierung nach Position
    if($data['param']['order_cat_position'] == "true" && $data['param']['categories'] != ""){
        $data['data'] = array_flip($cat_ids);
        while($row = $result->FetchRow()){
            $data['data'][$row['id']]= $row;
        }
    
    }else {
        $data['data'] = XT::getQueryData($result);
    }
}

XT::assign("xt" . XT::getBaseID() . "_filtered_list", $data);
$content = XT::build($data['param']['style']);

?>