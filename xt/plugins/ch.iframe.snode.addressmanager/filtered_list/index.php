<?php
// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Parameter :: categories - filtern nach categories
// Parameter categories auf postwert prüfen, wenn nicht vorhanden auf sessionvert prüfen, wenn nicht vorhanden parameter wert verwenden
$categories = XT::autoval("categories","R",null);
$order_by_category_position = XT::getParam('orderByCategoryPosition') == false ? XT::getParam('orderByCategoryPosition') : true;

// sortierung
$searchparams = "a1.title,a1.tel,a1.postalCode,a1.city,a1.country,country1.name";

$data['sort'] = explode(",", $searchparams);

XT::loadClass("ordering.class.php","ch.iframe.snode.core");
$order = new XT_Order($searchparams,"a1.title",1,"default");
$order->setListener("sort","sortby");


// Parameter :: property_id - filtern nach eigenschaften
$property_id = XT::getParam('property_id') != '' ? XT::getParam('property_id') : NULL;
$data['property_id'] = $property_id;

// Parameter :: mixFilterResults false für "AND", true für "OR" - beide filterresultate mischen, default ist true
$mixFilterResults = XT::getParam('mixFilterResults') != '' ? XT::getParam('mixFilterResults') : true;


// werte setzen oder aus der session holen
$propsessval = XT::getSessionValue('property');
if(XT::getParam("property_value") != ""){
	$property_value = $propsessval[$property_id] = XT::getParam("property_value");
}else {
	
if(XT::getValue('property')){
    $propvalue = XT::getValue('property');
    $property_value = $propvalue[$property_id] != '' ? $propvalue[$property_id] : NULL;
    $propsessval[$property_id] = $property_value;
    XT::setSessionValue('property',$propsessval);
}else{
    $property_value = $propsessval[$property_id];
}
}





// ids holen wenn props vorhanden sind
$prop_ids = array();
if(!is_null($property_id) && !is_null($property_value)){
    // ids holen die für den filter zutreffen
    $propfilter = XT::getQueryData(XT::query("SELECT content_id from " . XT::getTable("properties_values") . " WHERE property_id=" . $property_id . " AND content_type=" . XT::getBaseID() . "
    AND value='" . $property_value . "'",__FILE__,__LINE__));

    foreach ($propfilter as $values) {
        $prop_ids[$values['content_id']] = $values['content_id'];
    }
}
// ids aus Kategorien holen wenn welche vorhanden sind
$cat_ids = array();
if(!is_null($categories)){
    // ids holen die für den filter zutreffen
    $catfilter = XT::getQueryData(XT::query("SELECT DISTINCT target_content_id as content_id from " . XT::getTable("relations") . " WHERE content_type=5500 AND target_content_type=" . XT::getBaseID() . "
    AND content_id in(" . $categories . ") ORDER by position",__FILE__,__LINE__));
    foreach ($catfilter as $values) {
        $cat_ids[$values['content_id']] = $values['content_id'];
    }
}
// filter mischen oder auch nicht
if($mixFilterResults){
    $ids = array_merge($cat_ids,$prop_ids);
}else {
    $ids = array_intersect($cat_ids,$prop_ids);
}

// id in wert für sql aufbauen
$id = '';
$id = implode(",",$ids);

// Daten holen wenn ids vorhandnen sind
if ($id !=''){
    // Get address details
    $result = XT::query("
    SELECT
        a1.*,
        a2.id as org_id,
        a2.title as org_title,
        a2.type as org_type,
        a2.email as org_email,
        a2.postalCode as org_postalCode,
        a2.city as org_city,
        a2.street as org_street,
        a2.state as org_state,
        a2.country as org_country,
        a2.status as org_status,
        a2.tel as org_tel,
        a2.fax as org_fax,
        a2.website as org_website,
        a2.image as org_image,
        a3.id as dep_id,
        a3.title as dep_title,
        a3.type as dep_type,
        a3.email as dep_email,
        a3.postalCode as dep_postalCode,
        a3.city as dep_city,
        a3.street as dep_street,
        a3.state as dep_state,
        a3.country as dep_country,
        a3.status as dep_status,
        a3.tel as dep_tel,
        a3.fax as dep_fax,
        a3.website as dep_website,
        a3.image as dep_image,
        country1.name as countryname,
        country2.name as org_countryname,
        country3.name as dep_countryname        
    FROM
        " . XT::getDatabasePrefix() . "addresses as a1
    LEFT JOIN
        " . XT::getDatabasePrefix() . "addresses as a2 ON (a1.organization = a2.id)
    LEFT JOIN
        " . XT::getDatabasePrefix() . "addresses as a3 ON (a1.organizationalUnit = a3.id)
    LEFT JOIN
        " . XT::getDatabasePrefix() . "countries as country1 ON(a1.country = country1.country)
    LEFT JOIN
        " . XT::getDatabasePrefix() . "countries as country2 ON(a2.country = country2.country)
    LEFT JOIN
        " . XT::getDatabasePrefix() . "countries as country3 ON(a3.country = country3.country)
    WHERE
        a1.id IN (" . $id . ")
    AND
        a1.active = 1
    AND
        (a1.display_time_start = 0 OR a1.display_time_start < " . time() . ")
    AND
        (a1.display_time_end = 0 OR a1.display_time_end > " . time() . ")" . $order->get()
    ,__FILE__,__LINE__);


    if($order_by_category_position && $categories !=""){
        // sortierung nach position
        $data['data'] = array_flip($ids);
        while($row = $result->FetchRow()){
            $data['data'][$row['id']]= $row;
        }

    }else {
        $data['data'] = XT::getQueryData($result,"id");
    }
}
$data['filter']['value'] = $property_value;

XT::assign("xt" . XT::getBaseID() . "_filtered_list", $data);

$content = XT::build($style);

?>