<?php
/**
 * Param :: category_id
 */
$category_id = XT::autoVal("category_id","R",0);
$recursive = XT::autoVal("recursive","P",false);

if($recursive){
    // ids der nodes recursive holen

    $result = XT::query("
            SELECT
                n1.id,
                nodes.title as nodetitle,
                nodes.description,
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
            $data['mainnode']['description'] = $row['description'];
        }
        $data['nodes'][$row['id']]['title'] =  $row['nodetitle'];
        $data['nodes'][$row['id']]['level'] =  $row['level'];
        $data['nodes'][$row['id']]['pid'] =  $row['pid'];
        $tree[] = $row['id'];
        ++$i;
    }
    if(is_array($tree)){
    $category_id = implode(",",$tree);
    }

}else {
    $result = XT::query("Select title,node_id as id,description from " . XT::getTable("events_tree_details") . " WHERE lang='" . XT::getLang() . "' AND node_id=" . $category_id,__FILE__,__LINE__);
    if ($row = $result->FetchRow()){
        $data['mainnode']['title'] = $row['title'];
        $data['mainnode']['id'] = $row['id'];
        $data['mainnode']['description'] = $row['description'];
    }
}

// Daterange Parameter
$year_absolute = intval(XT::getParam("year_absolute"));
$start_month = intval(XT::getParam("start_month"));
$year_relative = intval(XT::getParam("year"));
$archiv = intval(XT::getParam("archiv"));

// Falls kein Ausgangsjahr angegeben wurde, das aktuelle Jahr als Basis nehmen
if(!$year_absolute) {
    $year_absolute = date("Y", TIME);
}

// Die Relations beruecksichtigen
$year = $year_absolute + $year_relative;

// Falls der Startmontat nicht gesetzt ist
if(!$start_month) {
    $daterange[0] = mktime(0, 0, 0, 1, 1, $year);
    $daterange[1] = mktime(0, 0, 0, 1, 1, $year+1)-1;
}
else {
    $daterange[0] = mktime(0, 0, 0, $start_month, 1, $year);
    $daterange[1] = mktime(0, 0, 0, $start_month, 1, $year+1)-1;
}

// Falls es sich um ein Archiv handelt nur die vergagenen Events darstellen
if($archiv && $daterange[1] > TIME) {
    $daterange[1] = TIME;
}

//echo date("d.m.Y", $daterange[0]) . " - " . date("d.m.Y", $daterange[1]);

/**
 * Param :: style
 */
$style = XT::getParam("style") == "" ? "default.tpl" : XT::getParam("style");

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


/**
 * Get all events in this category
 */
$result = XT::query("
    SELECT
        events.*,
        details.title,
        details.introduction,
        details.image,
        details.image_version,
        details.link,
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
        " . XT::getTable("events") . " AS events
    INNER JOIN
        " . XT::getTable("events_details") . " AS details ON (
            details.id = events.id AND
            details.active = 1 AND
            details.lang = '". XT::getLang() . "'
        )
    INNER JOIN
        " . XT::getTable("events_tree_rel") . " AS rel ON (
            rel.node_id IN({$category_id}) AND
            rel.event_id = events.id
        )
    LEFT JOIN
        " . XT::getTable("events_tree_details") . " AS nodes ON (
            nodes.node_id = rel.node_id AND
            nodes.lang = '". XT::getLang() . "'
        )
    LEFT JOIN
        " . XT::getTable("addresses") . " AS addr ON (
            addr.id = events.address
        )
    WHERE
        events.from_date > {$daterange[0]} AND
        events.end_date < {$daterange[1]} AND
        (events.display_time_start = 0 OR events.display_time_start < " . TIME . ") AND
        (events.display_time_end = 0 OR events.display_time_end > " . TIME . ")
        {$filter}
    ORDER BY
        events.from_date ASC
",__FILE__,__LINE__,0);

$additionaldata['count']=0;


while($row = $result->fetchRow()) {
    $data['data'][date("m",$row['from_date'])][] = $row;
    $data['nodes'][$row['nodeid']]['title'] =  $row['nodetitle'];
    $data['nodes'][$row['nodeid']]['events'][] = $row['id'];
    $data['additionaldata']['count']++;
}

$data['additionaldata']['year']=date("Y",$daterange[0]);

XT::assign("xt" . XT::getBaseID() . "_monthlist", $data);

$content = XT::build($style);
?>