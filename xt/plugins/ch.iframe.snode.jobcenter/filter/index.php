<?php

$data = array();

// Parameter :: style
$data['param']['style'] = XT::autoval("style", "P", "default.tpl");

// Param :: categories
$data['param']['category'] = intval(XT::autoval("category","P", 1));

// Inputs
$cat_selected = XT::getValue("categories");
$city_selected = XT::getValue("cities");

// Kategorien zusammenstellen
if($data['param']['category'] > 0) {
    
    $result = XT::query("
        SELECT
            det.title,
            det.subtitle,
            det.description,
            t.id,
            t.level
        FROM
            " . XT::getTable("category_tree") . " as t
        LEFT JOIN
            " . XT::getTable("category_nodes") . " as det ON (t.id = det.node_id AND det.lang = '" . XT::getLang() ."')
        WHERE
            t.pid = " . $data['param']['category'] . "
        GROUP BY
            t.id
        ORDER BY
            t.l
    ",__FILE__,__LINE__);
    
    while($row = $result->fetchRow()) {
        $data['data']['categories'][$row['id']] = $row;
        $data['data']['categories'][$row['id']]['selected'] = 0;
        if($cat_selected == $row['id']) {
            $data['data']['categories'][$row['id']]['selected'] = 1;
        }
        $categories[$row['id']] = $row['id'];
    }
    
    $data['default_values']['categories'] = implode(",", $categories);
    
    // Falls keine Kategorie gewaehlt wurde (z.B. bei einem Erstaufruf) werden alle Kategorien gewaehlt
    if(empty($cat_selected)) {
        XT::setValue("categories",$data['default_values']['categories']);
    }
    
    // Adressen zu Jobs aus Relations zusammentragen
    $result = XT::query("
        SELECT
            a.city as title
        FROM
            " . XT::getTable("relations") . " as rel
        INNER JOIN
            " . XT::getTable("jobs") . " as j ON (rel.target_content_id = j.id)
        LEFT JOIN
            " . XT::getTable("addresses") . " as a ON (j.location_id = a.id)
        WHERE
            rel.content_type = 5500 AND
            rel.content_id IN (" . $data['default_values']['categories'] . ") AND
            rel.target_content_type = " . XT::getBaseID() . "
        GROUP BY
            a.id
    ",__FILE__,__LINE__);
    
    while($row = $result->fetchRow()) {
        $data['data']['cities'][$row['title']] = $row;
        $data['data']['cities'][$row['title']]['selected'] = 0;
        if($city_selected == $row['title']) {
            $data['data']['cities'][$row['title']]['selected'] = 1;
        }
        $cities[$row['title']] = $row['title'];
    }
    $data['default_values']['cities'] = implode(",", $cities);

}

XT::assign("xt" . XT::getBaseID() . "_filter", $data);
$content = XT::build($data['param']['style']);

?>