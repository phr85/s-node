<?php
/**
 * Param :: category_id
 */
$category_ids = XT::autoVal("category_id","R",0);
$recursive = XT::autoVal("recursive","P",false);

$category_ids = explode(",", str_replace(" ","", $category_ids));

foreach($category_ids as $category_id) {
    
    if($recursive){
        
        // ids der nodes recursive holen
        $result = XT::query("
                SELECT
                    n1.id,
                    nodes.title as nodetitle,
                    n1.level,
                    n1.pid
                FROM
                    " . XT::getTable("events_tree") . " AS n1
                    LEFT JOIN
                    " . XT::getTable("events_tree_details") . " as nodes on(n1.id = nodes.node_id and nodes.lang='" . XT::getLang() . "'),
                    " . XT::getTable("events_tree") . " AS n2
                WHERE
                    n2.id ='" . $category_id . "'
                    AND n1.l >= n2.l
                    AND n1.r <= n2.r
                    AND nodes.active = 1
                GROUP BY
                    n1.ID
                ORDER BY
                    n1.l ASC
            ",__FILE__,__LINE__);
        $i =1;
        while ($row = $result->FetchRow()){
            if($i ==1){
                $data['mainnode']['title'] = $row['nodetitle'];
                $data['mainnode']['id'] = $row['id'];
            }
            $data['nodes'][$row['id']]['title'] =  $row['nodetitle'];
            $data['nodes'][$row['id']]['level'] =  $row['level'];
            $data['nodes'][$row['id']]['pid'] =  $row['pid'];
            $tree[] = $row['id'];
            ++$i;
        }
    
    }else {
        $result = XT::query("Select title,node_id as id from " . XT::getTable("events_tree_details") . " WHERE lang='" . XT::getLang() . "' AND node_id=" . $category_id,__FILE__,__LINE__);
        while ($row = $result->FetchRow()){
            $data['mainnode']['title'] = $row['title'];
            $data['mainnode']['id'] = $row['id'];
            $tree[] = $row['id'];
        }
    }
}

/**
 * Param :: style
 */
$style = XT::getParam("style") == "" ? "default.tpl" : XT::getParam("style");

// Von welchem Datum soll ausgegangen werden?
$now = XT::getParam("now") == "" ? time() : XT::getParam("now");

// Sollen zukünftige oder alte daten dargestellt werden
$display_old = XT::autoval("display_old","P",false);

// countryfilter
$filter_country = XT::autoval("filter_country","P",'unset');
if($filter_country != "unset"){
    $filter .= " AND events.country='" . $filter_country . "'";
}
// region
$filter_region = XT::autoval("filter_region","P",'unset');
if($filter_country != "unset" && $filter_region != "unset"){
    $filter .= " AND events.region_id='" . $filter_region . "'";
}

// zeitfilter
$filter_date_from  = XT::autoval("filter_date_from","R",'unset');
if($filter_date_from != "unset"){
    $filter .= " AND events.from_date > " . $filter_date_from ;
}
// zeitfilter
$filter_date_to  = XT::autoval("filter_date_to","R",'unset');
if($filter_date_to != "unset"){
    $filter .= " AND events.from_date > " . $filter_date_to ;
}
// falls nur ein von Datum gesetzt ist einen Monat dazu rechnen
elseif($filter_date_from != "unset"){
    $month = date("m",$filter_date_from);
    $year = date("Y",$filter_date_from);
    $filter .= " AND events.from_date < " . intval(mktime(0,0,1,$month+1,1,$year)-1) ;
}

// Date Filter Array
$thisyear = date("Y",TIME);
$months = array();

for($i = 1; $i < 13; $i++) {
    // $month['January'] = 1230764401;
    $months[date("F", mktime(0,0,1,$i,1, $thisyear))] = mktime(0,0,1,$i,1, $thisyear);
}

$data['months'] = $months;


/**
 * Param :: category_id
 */
$limit = XT::getParam("limit") == "" ? "" : " limit 0," . XT::getParam("limit");


/**
 * Get all events in this category
 */

/* Zukuenftige */
if (!$display_old){
    $condition = " AND events.end_date > " . TIME . " AND
        (events.display_time_start = 0 OR events.display_time_start < " . TIME . ")
    AND
        (events.display_time_end = 0 OR events.display_time_end > " . TIME . ")";
    $order = " ORDER by events.from_date ASC ";
/* Vergangene */
} else {
    $condition = " AND events.end_date < " . TIME . " AND
        (events.display_time_start = 0 OR events.display_time_start < " . TIME . ")
    AND
        (events.display_time_end = 0 OR events.display_time_end > " . TIME . ")";
    $order = " ORDER by  events.from_date DESC ";
}

if(is_array($tree)) {
    $result = XT::query("
        SELECT
            events.*,
            details.title,
            details.introduction,
            details.maintext,
            details.image,
            details.link,
            details.image_version,
            addr.title as addr_title,
            addr.firstName as addr_firstName,
            addr.lastName as addr_lastName,
            addr.email as addr_email,
            addr.postalCode as addr_postalCode,
            addr.city as addr_city,
            addr.street as addr_street,
            addr.website as addr_website,
            addr.country as addr_country,
            nodes.title as nodetitle,
            nodes.description as nodedescription,
            nodes.node_id as nodeid
    
        FROM
            " . XT::getTable("events_details") . " as details,
            " . XT::getTable("events_tree_rel") . " as rel
        LEFT JOIN
            " . XT::getTable("events_tree_details") . " as nodes on(rel.node_id = nodes.node_id and nodes.lang='" . XT::getLang() . "'),
            " . XT::getTable("events") . " as events
        LEFT JOIN
            " . XT::getTable("addresses") . " as addr ON(events.address = addr.id)
        WHERE
            details.lang='" . XT::getLang() . "' AND
            details.active = 1 AND
    
            events.id = rel.event_id AND
            details.id = rel.event_id AND
            rel.node_id in (" . implode(",",$tree)  . ") AND
            nodes.active = 1 AND
            details.lang='" . XT::getLang() . "'"
    . $filter . $condition . $order . $limit
    ,__FILE__,__LINE__);
    
    while($row = $result->fetchRow()) {
        $data['data'][$row['id']] = $row;
        $data['nodes'][$row['nodeid']]['title'] =  $row['nodetitle'];
        $data['nodes'][$row['nodeid']]['events'][] = $row['id'];
    }
}

XT::assign("xt" . XT::getBaseID() . "_list", $data);

$content = XT::build($style);

?>