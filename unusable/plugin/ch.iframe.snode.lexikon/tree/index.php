<?php

if(!$GLOBALS['plugin']->getSessionValue('node_id')){
    $GLOBALS['plugin']->setSessionValue('node_id',is_numeric($GLOBALS['plugin']->getParam("default_node")) ? $GLOBALS['plugin']->getParam("default_node"): 1);
}

if($GLOBALS['plugin']->getValue('node_id')){
    $GLOBALS['plugin']->setSessionValue('node_id',$GLOBALS['plugin']->getValue('node_id'));
}


$active_id = $GLOBALS['plugin']->getSessionValue('node_id');


/**
 * Parameter :: Start node (int => optional)
 */
$start_node = is_numeric($GLOBALS['plugin']->getParam("start_node")) ? $GLOBALS['plugin']->getParam("start_node"): NULL;
if($start_node > 0){
    $result = XT::query("SELECT id, l, r, level, pid FROM " . $GLOBALS['plugin']->getTable("tree") . " WHERE id=" .  $start_node ,__FILE__,__LINE__);
    $start_node = array();
    while ($row = $result->FetchRow()){
        $start_node = $row;
    }
}

/**
 * Parameter :: lang (string => default is the language setted by user)
 */
$lang = $GLOBALS['plugin']->getParam("lang") != '' ? $GLOBALS['plugin']->getParam("lang") : XT::getLang();

/**
 * Parameter :: start_level (int => default is 1)
 */
if($GLOBALS['plugin']->getParam("start_level") > 0){
    if(count($start_node) > 0){
        $start_level = $start_node['level'] + $GLOBALS['plugin']->getParam("start_level");
    }else{
        $start_level = $GLOBALS['plugin']->getParam("start_level") + 1;
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
$style = $GLOBALS['plugin']->getParam("style") !='' ? $GLOBALS['plugin']->getParam("style") : "default.tpl";

/**
 * Parameter :: all_nodes_open (true | false => default is false)
 */
$all_nodes_open = $GLOBALS['plugin']->getParam("all_nodes_open") == 1 ? true : false;



// Get the way
$result = XT::query("SELECT n1.id, COUNT(n1.id) AS level
FROM
    " . $GLOBALS['plugin']->getTable("tree") . " AS n1,
    " . $GLOBALS['plugin']->getTable("tree") . " AS n2
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
    if($GLOBALS['plugin']->getParam("force_show") == 1){
        $in = "-1";
    }
}
if($in != ''){
    $result = XT::query("SELECT main.id, main.pid, details.title, floor(( main.r - main.l) / 2) AS subs, main.level as level, main.l, main.r
                    FROM
                        " . $GLOBALS['plugin']->getTable("tree") . " AS main LEFT JOIN
                        " . $GLOBALS['plugin']->getTable("nodes") . " AS details ON (details.node_id = main.ID AND details.lang = '" . $lang . "')
                    WHERE
                        main.pid in (" . $in . ")
                        AND details.active = 1
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

    // subnodes(assigned entries)
    $result = XT::query("SELECT ld.title, ld.id from xt_lexikon_tree_articles as lta
    LEFT JOIN xt_lexikon_articles_details as ld on(ld.id = lta.article_id AND ld.lang='de')
    WHERE ld.active=1 AND lta.node_id=" . $GLOBALS['plugin']->getSessionValue("node_id"),__FILE__,__LINE__);
    $data = array();
    while ($row = $result->FetchRow()){
        $data[] = $row;
    }
    XT::assign("SUBENTRIES", $data);
    XT::assign("SUBACTIVE", $GLOBALS['plugin']->getValue("article_id")!='' ? $GLOBALS['plugin']->getValue("article_id") : $GLOBALS['plugin']->getValue("lexikon_id",0,1200));
    $content = XT::build($style);
}

?>
