<?php
// reset sql limitation array
$sql = array();
$no_nodes = false;
$sql['must'] = 'details.public = 1 AND details.active = 1';


/**
 * Parameter :: node (int => default is 1)
 */


if($GLOBALS['plugin']->getParam("node") != ''){
    $node_id = $GLOBALS['plugin']->getParam("node");
}else {
	$node_id = 1;
}

// get node details
$result = XT::query("SELECT id, l, r, pid, level FROM " . $GLOBALS['plugin']->getTable("tree") . " WHERE id='" . $node_id . "'" ,__FILE__,__LINE__);
$node = array();
if ($row = $result->FetchRow()){
    $node = $row;
      $sql['tree_limit'] = ' AND main.l > ' . $node['l'] . ' AND main.r < ' . $node['r'];
}else{
    $no_nodes = true;
}


if(XT::getValue("node") != ''){
    $node_id = XT::getValue("node");
}else{
    if(XT::getSessionValue("node") != ''){
        $node_id = XT::getSessionValue("node");
    }else {
        $node_id = 1;
    }
}

if(XT::getValue('node') !=''){
    XT::setSessionValue('node',$node_id);
}

/**
 * Parameter :: follow ( true |  false => default is false)
 */
if ($GLOBALS['plugin']->getParam("follow") == 1){
    // get follow details
    $result = XT::query("SELECT id, l, r, pid, level FROM " . $GLOBALS['plugin']->getTable("tree") . " WHERE id='" . $node_id . "'" ,__FILE__,__LINE__);
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
                " . $GLOBALS['plugin']->getTable("tree") . " AS n1,
                " . $GLOBALS['plugin']->getTable("tree") . " AS n2
            WHERE
                n2.id ='" . $node_id . "'
                AND n1.l <= n2.l
                AND n1.r >= n2.r

            GROUP BY
                n1.ID
            ORDER BY
                n1.l ASC
        ",__FILE__,__LINE__);
$count = 0;
$in = 0;
while ($row = $result->FetchRow()){
    $way[$count] = $row['id'];
    $count++;
    $in .= ',' . $row['id'];
}

if($in != '' && !$no_nodes){
    $result = XT::query("
            SELECT
                main.id,
                main.pid,
                details.title,
                details.subtitle,
                floor(( main.r - main.l) / 2) AS subs,
                main.l,
                main.r,
                details.image,
                details.image_version,
                details.public,
                details.description,
                main.level - 1 as level,
                details.active

            FROM
                " . $GLOBALS['plugin']->getTable("tree") . " AS main LEFT JOIN
                " . $GLOBALS['plugin']->getTable("nodes") . " AS details ON (details.node_id = main.ID AND details.lang = '" . $lang . "')
            WHERE "
    . $sql['open_depth'] . "
    ( main.pid in (" . $in . ")"
    . $sql['start_level']
    . $sql['depth']
    . $sql['tree_limit']
    . $sql['overview'] . ")"
    . $sql['show_start_node']
    . " AND " . $sql['must'] . "
            GROUP BY
                main.l
            ORDER BY
                main.l
        ",__FILE__,__LINE__);


    $data['tree'] = array();
    $root_count = 0;
    $last_elements = array();
    $first_elements = array();
    $node_before = $node_id;

    while ($row = $result->FetchRow()){
        $row['itw'] = in_array($row["id"], $way);
        if($row['id'] == $node_id){
            $row['selected'] = 1;
        }
        if($start_node['id'] > 1){
            $row['level'] = $row['level'] - $start_node['level'] + 3;
        }
        if($row['pid'] == $node_before){
            $row['first_child'] = 1;
        }else {
            $row['first_child'] = 0;
        }

        $node_before = $row['id'];

        $last_elements[$row['id']] = $row['r'];

        if($row['pid'] !=0 && ($row['public'] == 1 || XT::getNodePermission($row['id'],'view',$row['pid']))){
            $data['tree'][] = $row;
        }

    }
    $level_before = 0;
    foreach ($data['tree'] as $key => $value){
        if($value['level'] < $level_before){
            $data['tree'][$key -1]['last_child'] = 1;
        }else{
            if($key == 0){
                $data['tree'][count($data['tree']) -1]['last_child'] = 1;
            }else{
                $data['tree'][$key -1]['last_child'] = 0;
            }
        }
        $level_before = $value['level'];
    }
    $data['way'] = @$way;
    $data['last_elements'] = @$last_elements;
    $data['admin_tpl'] = $GLOBALS['plugin']->getConfig('admin_tpl');
    XT::assign("DATA", $data);
    $content = XT::build($style);
}

?>