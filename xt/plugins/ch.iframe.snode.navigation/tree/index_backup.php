<?php

/**
 * Parameter :: Profile (string => default from config)
 */
$profile = $GLOBALS['plugin']->getParam("profile") != '' ? $GLOBALS['plugin']->getParam("profile") : $GLOBALS['plugin']->getConfig('default_profile');
$result = XT::query("SELECT title, id, l, r, pid FROM " . $GLOBALS['plugin']->getTable("navigation") . " WHERE isProfile = 1 AND title='" . $profile . "'" ,__FILE__,__LINE__);
$profile = array();
while ($row = $result->FetchRow()){
    $profile = $row;
}

/**
 * Parameter :: Profile ID (int => default from config)
 */
$profile_id = $GLOBALS['plugin']->getParam("profile_id") != '' ? $GLOBALS['plugin']->getParam("profile_id") : null;
if($profile_id != null){
    $result = XT::query("SELECT id, l, r, pid FROM " . $GLOBALS['plugin']->getTable("navigation") . " WHERE id=" . $profile_id . "" ,__FILE__,__LINE__);
    $profile = array();
    while ($row = $result->FetchRow()){
         $profile = $row;
    }
}

/**
 * Parameter :: Start node (int => optional)
 */
$start_node = is_numeric($GLOBALS['plugin']->getParam("start_node")) ? $GLOBALS['plugin']->getParam("start_node"): NULL;
if($start_node > 0){
    $result = XT::query("SELECT title, id, l, r, level, pid FROM " . $GLOBALS['plugin']->getTable("navigation") . " WHERE id=" .  $start_node ,__FILE__,__LINE__);
    $start_node = array();
    while ($row = $result->FetchRow()){
        $start_node = $row;
    }
}
/**
 * fill the temp_node array with
 */
$temp_node_id = XT::getTemplateID();
$result = XT::query("SELECT title, id, l, r, level FROM " . $GLOBALS['plugin']->getTable("navigation") . " WHERE id=" .  $temp_node_id ,__FILE__,__LINE__);
$temp_node = array();
while ($row = $result->FetchRow()){
    $temp_node = $row;
}

/**
 * Parameter :: follow ( true |  false => default is false)
 */
$follow_id = $GLOBALS['plugin']->getParam("follow") == 1 ? true : false;

/**
 * Parameter :: description ( true |  false => default is false)
 */
$additional = '';
$description = $GLOBALS['plugin']->getParam("description") == 1 ? true : false;
$additional .= $description ? ",description" : "";

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
 * Parameter :: depth (int => default is endless)
 */
if($GLOBALS['plugin']->getParam("depth") > 0){
    $depth = "AND main.level <= " . ($start_level + $GLOBALS['plugin']->getParam("depth"));
}else{
    $depth = "";
}

/**
 * Parameter :: style (string  => default is tree.tpl)
 */
$style = $GLOBALS['plugin']->getParam("style") !='' ? $GLOBALS['plugin']->getParam("style") : "default.tpl";

/**
 * Overview ?
 */
$overview = '';
if(substr($style,0,8) == 'overview'){
    $overview = ' AND details.show_in_overview = 1';
}

/**
 * Parameter :: all_nodes_open (true | false => default is false)
 */
$all_nodes_open = $GLOBALS['plugin']->getParam("all_nodes_open") == 1 ? true : false;



// check if node is IN profile else get the profile id
if($profile["l"] <= $temp_node["l"] && $profile["r"] >= $temp_node["r"]){

}else{
    if($GLOBALS['plugin']->getParam("open_node") > 0){
        $active_id = $GLOBALS['plugin']->getParam("open_node");
    }else{
        $active_id = $profile["id"];
    }
    $GLOBALS['application']->setIn($active_id);
}


/**
 * Parameter :: show_start_node (true | false  => default is false)
 */
$show_start_node = '';
if($GLOBALS['plugin']->getParam("show_start_node") == 1){
    if($start_node['id'] > 1){
        $show_start_node =  " OR main.id = " . $start_node['id'];
    }else{
        if($GLOBALS['application']->getIn(2) > 0){
            $show_start_node =  " OR main.id = " . $GLOBALS['application']->getIn(2);
        } else {
            $show_start_node =  " OR main.id = -1";
        }
    }
}

/*
if($in == ''){
    if($GLOBALS['plugin']->getParam("force_show") == 1){
    $in = "-1";
    }
}
*/

if($GLOBALS['application']->getIn() != ''){

    if($all_nodes_open){
        $result = XT::query("
            SELECT
                tmp.id,
                tmp.pid,
                details.title,
                details.ext_link,
                details.target,
                details.description,
                floor(( tmp.r - tmp.l) / 2) AS subs,
                tmp.level - 2 as level,
                details.active,
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
                tmp.l,
                tmp.r,
                details.public " . $additional . "
            FROM
                " . $GLOBALS['plugin']->getTable("navigation") . " AS main,
                " . $GLOBALS['plugin']->getTable("navigation") . " AS tmp LEFT JOIN
                " . $GLOBALS['plugin']->getTable("navigation_details") . " AS details ON (details.node_id = tmp.ID AND details.lang = '" . $lang . "')
            WHERE
                details.visible = 1 AND
                details.active = 1 AND
                tmp.l >= main.l AND
                tmp.r <= main.r AND
                main.pid in (" . $GLOBALS['application']->getIn() . ") AND
                main.level > " . $start_level . "
                " . $show_start_node . "
                " . $depth . "
                " . $overview . "
            GROUP BY
                tmp.l
            ORDER BY
                tmp.l
        ",__FILE__,__LINE__,0);
    } else {
        $result = XT::query("
            SELECT
                main.id,
                main.pid,
                details.title,
                details.ext_link,
                details.target,
                details.description,
                floor(( main.r - main.l) / 2) AS subs,
                main.level - 2 as level,
                details.active,
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
                main.l,
                main.r,
                details.public " . $additional . "
            FROM
                " . $GLOBALS['plugin']->getTable("navigation") . " AS main LEFT JOIN
                " . $GLOBALS['plugin']->getTable("navigation_details") . " AS details ON (details.node_id = main.ID AND details.lang = '" . $lang . "')
            WHERE
                details.visible = 1 AND
                details.active = 1 AND
                main.pid in (" . $GLOBALS['application']->getIn() . ") AND
                main.level > " . $start_level . "
                " . $show_start_node . "
                " . $depth . "
                " . $overview . "
            GROUP BY
                main.l
            ORDER BY main.l
        ",__FILE__,__LINE__);
    }

    $data = array();
    $root_count = 0;
    $last_elements = array();
    $first_elements = array();
    while ($row = $result->FetchRow()){

        // Generate Images
        if($row['nav_image_generated_enabled'] == 1){
            /*
            $im = imagecreate(400, 30);
            $black = ImageColorAllocate ($im, 0, 0, 0);
            $white = ImageColorAllocate ($im, 255, 255, 255);
            ImageTTFText($im, 20, 0, 10, 20, $white, "/path/arial.ttf","Teste... Omega: &#937;");
            ImagePng($im);
            ImageDestroy($im);
            */
        }

        $row['itw'] = in_array($row["id"], $GLOBALS['application']->getWay());
        $row['selected'] = $row['id'] == $GLOBALS['tpl_id'];
        if($start_node['id'] > 1){
            $row['level'] = $row['level'] - $start_node['level'] + 3;
        }
        if($all_nodes_open && ($row['level'] == ($start_level-1))){
            $root_count++;
            $row['root_count'] = $root_count;
        }
        $last_elements[$row['id']] = $row['r'];

        if($row['public'] == 1 || XT::getNodePermission($row['id'],'view',$row['pid'])){
            $data[] = $row;
        }
    }

    XT::assign("LAST_ELEMENTS", $last_elements);
    //XT::assign("FIRST_ELEMENTS", $first_elements);
    XT::assign("DATA", $data);
    XT::assign("ADMIN_TPL", $GLOBALS['plugin']->getConfig('admin_tpl'));

    $content = XT::build($style);
}

?>
