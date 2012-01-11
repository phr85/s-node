<?php
// reset sql limitation array
$sql = array();
$no_nodes = false;
$sql['must'] = 'details.active = 1';

// opennode_id ist der aktuell geöffnete node, mit dem param defaultnode kann der "ausgewählte" node gesetzt werden
$opennode_id = XT::autoval("node","r",XT::autoval("defaultnode","R",XT::getParam('node')));
$node_id= XT::autoval("node","P",1);


// get node details
$result = XT::query("SELECT id, l, r, pid, level FROM " . $GLOBALS['plugin']->getTable("articles_tree") . " WHERE id=" . $node_id  ,__FILE__,__LINE__);
$node = array();
if ($row = $result->FetchRow()){
    $node = $row;
    $sql['tree_limit'] = ' AND main.l > ' . $node['l'] . ' AND main.r < ' . $node['r'];
}else{
    $no_nodes = true;
}
/**
 * Parameter :: follow ( true |  false => default is false)
 */
if ($GLOBALS['plugin']->getParam("follow") == 1){
    // get follow details
    $result = XT::query("SELECT id, l, r, pid, level FROM " . $GLOBALS['plugin']->getTable("articles_tree") . " WHERE id='" . XT::getSessionValue('node') . "'" ,__FILE__,__LINE__);
    $follow = array();
    while ($row = $result->FetchRow()){
        if($row['l'] >= $node['l'] && $row['r'] <= $node['r']){

            $sql['tree_limit'] = ' AND main.l >= ' . $row['l'] . ' AND main.r <= ' . $row['r'];

        }else{
            $no_nodes = true;
        }
    }
}

/**
 * Parameter :: show_start_node (bool => default is false)
 */
if($GLOBALS['plugin']->getParam("show_start_node") != ''){
    $sql['show_start_node'] = ' OR main.id =' . $node['id'];
}else{
    $sql['show_start_node'] = '';
}

/**
 * start_level relative from start node (int => default is 1)
 */

if(is_numeric($GLOBALS['plugin']->getParam("start_level"))){
    $sql['start_level'] = ' AND main.level >= ' . ($node['level'] + $GLOBALS['plugin']->getParam("start_level"));
}else{
    $sql['start_level'] = '';
}

/**
 * depth relative from start node (int => default is "no limit")
 */
if(is_numeric($GLOBALS['plugin']->getParam("depth"))){
    $sql['depth'] = ' AND main.level <= ' . ($node['level'] + $GLOBALS['plugin']->getParam("depth"));
}else{
    $sql['depth'] = '';
}

/**
 * open_depth relative from start node (int => default is 1)
 */
if(is_numeric($GLOBALS['plugin']->getParam("open_depth"))){
    $sql['open_depth'] = "(main.level <= " . ($node['level'] + $GLOBALS['plugin']->getParam("open_depth")) . " AND " . $sql['must'] . $sql['start_level'] . $sql['depth'] . $sql['tree_limit'] . $sql['overview'] . ") OR ";
}else{
    $sql['open_depth'] = '';
}

/**
 * Parameter :: description ( true |  false => default is false)
 */
$description = $GLOBALS['plugin']->getParam("description") == 1 ? true : false;
$sql['description'] .= $description ? ",description" : "";

/**
 * Parameter :: lang (string => default is the language setted by user)
 */
$lang = $GLOBALS['plugin']->getParam("lang") != '' ? $GLOBALS['plugin']->getParam("lang") : XT::getLang();

/**
 * Parameter :: style (string  => default is tree.tpl)
 */
$style = $GLOBALS['plugin']->getParam("style") !='' ? $GLOBALS['plugin']->getParam("style") : "default.tpl";


// Get the way
$result = XT::query("
            SELECT
                n1.id
            FROM
                " . $GLOBALS['plugin']->getTable("articles_tree") . " AS n1,
                " . $GLOBALS['plugin']->getTable("articles_tree") . " AS n2
            WHERE
                n2.id ='" . $opennode_id . "'
                AND n1.l <= n2.l
                AND n1.r >= n2.r
            GROUP BY
                n1.ID
            ORDER BY
                n1.l ASC
        ",__FILE__,__LINE__);
$count = 0;
$in = "0";
while ($row = $result->FetchRow()){
    $way[$count] = $row['id'];
    $count++;
    $in .= ',' . $row['id'];
}

XT::setTreeWay($way);
if($in != '' && !$no_nodes){
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
                details.public " . $sql['description'] . "
            FROM
                " . $GLOBALS['plugin']->getTable("articles_tree") . " AS main LEFT JOIN
                " . $GLOBALS['plugin']->getTable("articles_tree_details") . " AS details ON (details.node_id = main.ID AND details.lang = '" . $lang . "')
            WHERE "
    . $sql['open_depth'] . "
    ( main.pid in (" . $in . ")"
    . $sql['start_level']
    . $sql['depth']
    . $sql['tree_limit']
    . $sql['overview'] . ")"
    . $sql['show_start_node']
    . " AND " . $sql['must'] . "
    AND main.id !=1
            GROUP BY
                main.l
            ORDER BY
                main.l
        ",__FILE__,__LINE__);


    $data = array();
    $root_count = 0;
    $last_elements = array();
    $first_elements = array();
    while ($row = $result->FetchRow()){
        $row['itw'] = in_array($row["id"], $way);
        $row['selected'] = $row['id'] ==  XT::getSessionValue('node');
        if($start_node['id'] > 1){
            $row['level'] = $row['level'] - $start_node['level'] + 3;
        }
        if($all_nodes_open && ($row['level'] == ($start_level-1))){
            $root_count++;
            $row['root_count'] = $root_count;
        }
        $last_elements[$row['id']] = $row['r'];

        if($row['public'] == 1 || XT::getNodePermission($row['id'],'view',$row['pid'],1)){
            $data[$row['id']] = $row;
        }
    }
    foreach ($data as $key => $value) {
        $nodetree[$value['pid']][$value['id']] = $value['level'];
    }

    foreach ($way as $key => $value) {
    	$treeway[$key] = $data[$value];
    	if($data[$value]['selected']==1){

           XT::setSessionValue("TREESELECTED", $data[$value]);
           XT::assign("TREESELECTED",XT::getSessionValue("TREESELECTED"));
    	}
    }
    XT::assign("TREEWAY", $treeway);
    XT::setSessionValue("TREEWAY", $treeway);

    XT::assign("NODEARRAY", $nodetree);
    XT::assign("LAST_ELEMENTS", $last_elements);
    //XT::assign("FIRST_ELEMENTS", $first_elements);
    XT::assign("DATA", $data);
    XT::assign("ADMIN_TPL", $GLOBALS['plugin']->getConfig('admin_tpl'));

    $content = XT::build($style);
}
?>