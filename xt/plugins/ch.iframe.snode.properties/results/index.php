<?php

$selected_properties = XT::autoval("property","S");

$property_ids = XT::getParam('property') != '' ? XT::getParam('property') : NULL;
$intersect = XT::getParam('intersect') != '' ? XT::getParam('intersect') : true;

if(is_array($selected_properties)){
    $data = array();
    foreach (explode(",",$property_ids) as $value) {

        if($selected_properties[$value]!=""){
            $whereval = " AND
            value = '" . $selected_properties[$value] . "'";
        }else {
            $whereval = "";
        }

        $result = XT::query("
        SELECT
            content_type,
            content_id
        FROM
            " . XT::getTable("values") ."
        WHERE
            property_id = " . $value . "
        AND
            lang='" . XT::getLang() . "'" . $whereval
        ,__FILE__,__LINE__);
        while($row = $result->FetchRow()){
            $prop[$value][$row['content_type']][$row['content_id']] = $row['content_id'];
            $data[$row['content_type']][$row['content_id']] = $row['content_id'];

            // pseudoarray für intersect aufbauen
            foreach (explode(",",$property_ids) as $tempprop) {
                if(!is_array($prop[$tempprop][$row['content_type']])){
                    $prop[$tempprop][$row['content_type']] = array();
                }
            }

        }
    }
    // Schnittmenge oder aller resultate
    if($intersect){
        foreach ($prop as $propid => $value) {
            foreach ($value as $ctype => $cvalue) {
                $data[$ctype] = array_intersect($data[$ctype],$cvalue);
            }
        }
    }
    XT::assign("xt" . XT::getBaseID() . "_results",$data);
    // build content

    $content = XT::build(XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl');

    XT::clear_assign("xt" . XT::getBaseID() . "_results");
}

?>