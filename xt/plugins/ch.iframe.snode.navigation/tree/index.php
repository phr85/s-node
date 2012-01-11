<?php
// reset sql limitation array
$sql = array();
$no_nodes = false;
$sql['must'] = 'details.visible = 1 AND details.active = 1';

/**
 * Parameter :: Overview (bool => if is set gets only elements with overview tag)
 */

if($GLOBALS['plugin']->getParam("overview") == 1){
    $sql['must'] = 'details.show_in_overview AND details.active = 1';
}
if($GLOBALS['plugin']->getParam("overview") == 2){
    $sql['must'] = 'details.visible = 1 AND details.show_in_overview = 1 AND details.active = 1';
}

if($GLOBALS['plugin']->getParam("overview") == 3){
    $sql['must'] = 'details.visible = 0 AND details.show_in_overview = 1 AND details.active = 1';
}

if($GLOBALS['plugin']->getParam("overview") == 4){
    $sql['must'] = '(details.visible = 1 OR details.show_in_overview = 1) AND details.active = 1';
}

if($GLOBALS['plugin']->getParam("overview") == 5){
   $sql['must'] = '(details.visible = 0 OR details.show_in_overview = 0) AND details.active = 1';
}
/**
 * Parameter :: node (int => default is 10000)
 */

if($GLOBALS['plugin']->getParam("default_node") != '' && $_REQUEST['TPL'] == ''){
    $GLOBALS['application']->setIn($GLOBALS['plugin']->getParam("default_node"));
}

$node_id = xt::autoval("node","P",10000);
// get node details
$result = XT::query("SELECT title, id, l, r, pid, level FROM " . $GLOBALS['plugin']->getTable("navigation") . " WHERE id='" . $node_id . "'" ,__FILE__,__LINE__);
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
    $result = XT::query("SELECT title, id, l, r, pid, level FROM " . $GLOBALS['plugin']->getTable("navigation") . " WHERE id='" . $GLOBALS['tpl_id'] . "'" ,__FILE__,__LINE__);
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
    $sql['show_start_node'] = ' OR main.id =' . $node_id;
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
    $depth = $GLOBALS['plugin']->getParam("depth");
    $sql['depth'] = ' AND main.level <= ' . ($node['level'] + $GLOBALS['plugin']->getParam("depth"));
}else{
    $sql['depth'] = '';
}

/**
 * open_depth relative from start node (int => default is 1)
 */
if(is_numeric($GLOBALS['plugin']->getParam("open_depth"))){
    $open_depth = $GLOBALS['plugin']->getParam("open_depth");
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


if($GLOBALS['application']->getIn() != '' && !$no_nodes){
    $result = XT::query("
            SELECT
                main.id,
                main.pid,
                details.title,
                details.ext_link,
                details.blank,
                details.target,
                details.description,
                floor(( main.r - main.l) / 2) AS subs,
                main.level - 2 as level,
                details.active,
                details.show_in_overview,
                details.nav_image,
                details.nav_image_rollover,
                details.nav_image_active,
                details.nav_image_active_rollover,
                details.nav_image_version,
                details.nav_image_rollover_version,
                details.nav_image_active_version,
                details.nav_image_active_rollover_version,
                details.nav_image_generated_enabled,
                details.nav_image_active_generated_enabled,
                details.nav_image_rollover_generated_enabled,
                details.nav_image_active_rollover_generated_enabled,
                details.nav_image_generated_params,
                details.nav_image_active_generated_params,
                details.nav_image_rollover_generated_params,
                details.nav_image_active_rollover_generated_params,
                details.image,
                details.rewrite_name,
                main.l,
                main.r,
                details.public " . $sql['description'] . "
            FROM
                " . $GLOBALS['plugin']->getTable("navigation") . " AS main LEFT JOIN
                " . $GLOBALS['plugin']->getTable("navigation_details") . " AS details ON (details.node_id = main.ID AND details.lang = '" . $lang . "')
            WHERE "
    . $sql['open_depth'] . "
    ( main.pid in (" . $GLOBALS['application']->getIn() . ")"
    . $sql['start_level']
    . $sql['depth']
    . $sql['tree_limit']
    . $sql['overview'] . ")"
    . " AND " . $sql['must']
    . $sql['show_start_node'] . "
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
        if($row['blank']==1){
            $row['target'] = "_blank";
        }
        $row['itw'] = in_array($row["id"], $GLOBALS['application']->getWay());
        $row['selected'] = $row['id'] == $GLOBALS['tpl_id'];
        $last_elements[$row['id']] = $row['r'];

        if($row['public'] == 1 || XT::getNodePermission($row['id'],'view',$row['pid'])){
            $data[$row['id']] = $row;
            $elements[] = $row['id'];
        }
    }


    foreach ($data as $key => $value) {
        $nodetree[$value['pid']][$key] = $value['level'];
    }

    XT::assign("NODEARRAY", $nodetree);
    XT::assign("LAST_ELEMENTS", $last_elements);
    XT::assign("ELEMENTS", $elements);
    //XT::assign("FIRST_ELEMENTS", $first_elements);
    XT::assign("DATA", $data);
    XT::assign("ADMIN_TPL", $GLOBALS['plugin']->getConfig('admin_tpl'));
    
    /* new */
    $assigndata['data'] = $data;
    $assigndata['metadata']['node'] = $node_id;
    $assigndata['metadata']['depth'] = $depth;
    $assigndata['metadata']['open_depth'] = $open_depth;
    $assigndata['metadata']['nodearray'] = $nodetree;
    XT::assign("xt" . XT::getBaseID() . "_tree", $assigndata);
    /* eof new */

    $content = XT::build($style);
}
?>