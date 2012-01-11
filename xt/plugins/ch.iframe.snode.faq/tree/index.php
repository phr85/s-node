<?php

$data = array();

/**
 * Prepare :: Metadata
 */
$data['metadata']['opennode_id'] = XT::autoval("node", "r", XT::autoval("defaultnode", "R", XT::getParam('node')));
$data['metadata']['node_id'] = XT::autoval("node", "P", 1);
$data['metadata']['lang'] = XT::getParam("lang") != "" ? XT::getParam("lang") : XT::getLang();
$data['metadata']['style'] = XT::getParam("style") != "" ? XT::getParam("style") : "default.tpl";
$data['metadata']['admin_tpl'] = XT::getConfig('admin_tpl');

/**
 * Get :: Nodeinformation
 */
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable("faq_tree") . "
    WHERE
        id = " . $data['metadata']['node_id'] . "
    LIMIT 1
",__FILE__,__LINE__);
if($row = $result->FetchRow()) {
    $data['node'] = $row;
    $data['metadata']['sql']['tree_limit'] = " AND main.l > " . $data['node']['l'] . " AND main.r < " . $data['node']['r'];
}
else {
    $data['metadata']['no_nodes'] = true;
}


/**
 * Prepare :: tree_limit
 */
if (XT::getParam("follow") == 1) {
    $follow = array();
    $result = XT::query("
        SELECT
            *
        FROM
            " . XT::getTable("faq_tree") . "
        WHERE
            id = '" . XT::autoval("node", "S") . "'
    " ,__FILE__,__LINE__);
    while($row = $result->FetchRow()) {
        if($row['l'] >= $data['node']['l'] && $row['r'] <= $data['node']['r']) {
            $data['metadata']['sql']['tree_limit'] = " AND main.l >= " . $row['l'] . " AND main.r <= " . $row['r'];
        }
        else {
            $data['metadata']['no_nodes'] = true;
        }
    }
}

/**
 * Prepare :: sql
 */
$data['metadata']['sql']['must'] = " AND details.active = 1 ";
$data['metadata']['sql']['description'] = XT::getParam("description") == 1 ? ",description" : "";
$data['metadata']['sql']['show_start_node'] = XT::getParam("show_start_node") != "" ? " OR main.id = " . $data['node']['id'] : "";
$data['metadata']['sql']['start_level'] = is_numeric(XT::getParam("start_level")) ? " AND main.level >= " . ($data['node']['level'] + XT::getParam("start_level")) : "";
$data['metadata']['sql']['depth'] = is_numeric(XT::getParam("depth")) ? " AND main.level <= " . ($data['node']['level'] + XT::getParam("depth")) : "";
$data['metadata']['sql']['open_depth'] = is_numeric(XT::getParam("open_depth")) ? "(main.level <= " . ($data['node']['level'] + XT::getParam("open_depth")) . $data['metadata']['sql']['must'] . $data['metadata']['sql']['start_level'] . $data['metadata']['sql']['depth'] . $data['metadata']['sql']['tree_limit'] . ") OR " : "";


/**
 * Build :: treeway
 */
$result = XT::query("
    SELECT
        n1.id
    FROM
        " . XT::getTable("faq_tree") . " AS n1,
        " . XT::getTable("faq_tree") . " AS n2
    WHERE
        n2.id = '" . $data['metadata']['opennode_id'] . "' AND
        n2.l >= n1.l AND
        n2.r <= n1.r
    GROUP BY
        n1.id
    ORDER BY
        n1.l ASC
",__FILE__,__LINE__);

$way = array();
$count = 0;

$data['metadata']['sql']['in'] = "0";
while($row = $result->FetchRow()){
    $way[$count] = $row['id'];
    $data['metadata']['sql']['in'] .= ',' . $row['id'];
    $count++;
}
XT::setTreeWay($way);


/**
 * Get :: Treedata
 */
if($data['metadata']['sql']['in'] != "" && !$data['metadata']['no_nodes']) {
    $result = XT::query("
        SELECT
            main.id,
            main.pid,
            details.title,
            details.description,
            floor(( main.r - main.l) / 2) AS subs,
            main.level - 2 as level,
            details.active,
            details.image,
            main.l,
            main.r,
            details.public
            " . $data['metadata']['sql']['description'] . "
        FROM
            " . XT::getTable("faq_tree") . " AS main
        LEFT JOIN
            " . XT::getTable("faq_tree_details") . " AS details ON (details.node_id = main.ID AND details.lang = '" . $data['metadata']['lang'] . "')
        WHERE
            " . $data['metadata']['sql']['open_depth'] . "
            ( main.pid in (" . $data['metadata']['sql']['in'] . ")" .
            $data['metadata']['sql']['start_level'] .
            $data['metadata']['sql']['depth'] .
            $data['metadata']['sql']['tree_limit'] .
            $data['metadata']['sql']['overview'] . ")" .
            $data['metadata']['sql']['show_start_node'] .
            $data['metadata']['sql']['must'] . "
        GROUP BY
            main.l
        ORDER BY
            main.l
    ",__FILE__,__LINE__);
    
    while($row = $result->FetchRow()){
        $row['itw'] = in_array($row["id"], $way);
        $row['selected'] = $row['id'] ==  XT::autoval("node", "S");
        if($row['public'] == 1 || XT::getNodePermission($row['id'], "view", $row['pid'], 1)){
            $data['data'][$row['id']] = $row;
        }
    }
    
    foreach($data['data'] as $key => $value) {
        $data['nodearray'][$value['pid']][$value['id']] = $value['level'];
        $nodes[$key] = $key;
    }
    
    $data['metadata']['sql']['nodes'] = count($nodes) > 0 ? implode(",", $nodes) : "0";
    
    foreach($way as $key => $value) {
        $data['treeway'][$key] = isset($data['data'][$value]) ? $data['data'][$value] : $value;
        if($data['data'][$value]['selected'] == 1){
           XT::setSessionValue("treeselected", $data['data'][$value]);
           $data['metadata']['treeselected'] = XT::getSessionValue("treeselected");
        }
    }
    
    
    /**
     * Get :: questions
     */
    $result = XT::query("
        SELECT
            rel.node_id,
            rel.position,
            question.*
        FROM
            " . XT::getTable("faq") . " AS question
        INNER JOIN
            " . XT::getTable("faq2cat") . " AS rel ON (question.id = rel.faq_id)
        WHERE
            question.lang = '" . $data['metadata']['lang'] . "' AND
            question.active = 1 AND
            rel.node_id IN (" . $data['metadata']['sql']['nodes'] . ")
        ORDER BY
            rel.node_id,
            rel.position
    ",__FILE__,__LINE__);
    
    while($row = $result->fetchRow()) {
        $data['questions'][$row['node_id']][$row['position']] = $row;
    }
    
    
    XT::assign("xt" . XT::getBaseID() . "_tree", $data);
    $content = XT::build($data['metadata']['style']);
}

?>