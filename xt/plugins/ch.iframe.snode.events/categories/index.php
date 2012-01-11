<?php
if(!XT::getSessionValue('node_id')){
    XT::setSessionValue('node_id',is_numeric(XT::getParam("default_node")) ? XT::getParam("default_node"): 1);
}

if(XT::getValue('node_id')){
    XT::setSessionValue('node_id',XT::getValue('node_id'));
}

XT::setSessionValue('expression', null);

$active_id = XT::getSessionValue('node_id');


/**
 * Parameter :: Start node (int => optional)
 */
$start_node = is_numeric(XT::getParam("start_node")) ? XT::getParam("start_node"): NULL;
if($start_node > 0){
    $result = XT::query("
        SELECT 
            id, 
            l, 
            r, 
            level, 
            pid 
        FROM 
            " . XT::getTable("events_tree") . "
        WHERE 
            id=" .  $start_node
    ,__FILE__,__LINE__);
    
    $start_node = array();
    while ($row = $result->FetchRow()){
        $start_node = $row;
    }
}

/**
 * Parameter :: lang (string => default is the language setted by user)
 */
$lang = XT::getParam("lang") != '' ? XT::getParam("lang") : XT::getLang();

/**
 * Parameter :: start_level (int => default is 1)
 */
if(XT::getParam("start_level") > 0){
    if(count($start_node) > 0){
        $start_level = $start_node['level'] + XT::getParam("start_level");
    }else{
        $start_level = XT::getParam("start_level") + 1;
    }
}else{
    if(count($start_node) > 0){
        $start_level = $start_node['level'];
    }else{
        $start_level = 0;
    }
}


/**
 * Parameter :: style (string  => default is tree.tpl)
 */
$style = XT::getParam("style") !='' ? XT::getParam("style") : "default.tpl";

/**
 * Parameter :: all_nodes_open (true | false => default is false)
 */
$all_nodes_open = XT::getParam("all_nodes_open") == 1 ? true : false;

// Get the way
$result = XT::query("
    SELECT 
        n1.id, 
        COUNT(n1.id) AS level
    FROM
        " . XT::getTable("events_tree") . " AS n1,
        " . XT::getTable("events_tree") . " AS n2
    WHERE
        n2.id ='" . $active_id . "'
        AND n1.l <= n2.l
        AND n1.r >= n2.r
        AND n1.level >= " . $start_level . "
    GROUP BY
        n1.ID
    ORDER BY
        n1.l
",__FILE__,__LINE__,0);

// clear $in
$in = '';
$way = array();

while ($row = $result->FetchRow()){
   $in .= ', ' . $row['id'] ;
   $way[] = $row['id'];
}

$in = substr($in, 1);

if($in == ''){
    if(XT::getParam("force_show") == 1){
    $in = "-1";
    }
}
if($in != ''){
    $result = XT::query("
                    SELECT 
                        main.id, 
                        main.pid, 
                        details.title, 
                        floor(( main.r - main.l) / 2) AS subs, 
                        main.level as level, 
                        main.l, main.r
                    FROM
                        " . XT::getTable("events_tree") . " AS main LEFT JOIN
                        " . XT::getTable("events_tree_details") . " AS details ON (details.node_id = main.ID AND details.lang = '" . $lang . "')
                    WHERE
                        main.pid in (" . $in . ") AND 
                        details.active = 1
                        " . $show_start_node . "
                    GROUP BY
                        main.l
                    ORDER BY main.l
                ",__FILE__,__LINE__);
    $data = array();
    while ($row = $result->FetchRow()){
        $row['itw'] = in_array($row["id"], $way);
        $row['selected'] = $row['id'] == $active_id;
        if($start_node['id'] > 1){
            $row['level'] = $row['level'] - $start_node['level'] + 3;
        }
        $data[] = $row;
    }

    XT::assign("DATA", $data);

    $content = XT::build($style);
}

?>
