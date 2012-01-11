<?php

/**
 * Parameter :: style (string  => default is tree.tpl)
 */
$style = $GLOBALS['plugin']->getParam("style") !='' ? $GLOBALS['plugin']->getParam("style") : "default.tpl";


/**
 * Parameter :: Start node (int => optional)
 */
$start_level = is_numeric($GLOBALS['plugin']->getParam("level")) ? $GLOBALS['plugin']->getParam("level"): NULL;
if($start_level == NULL){
    $start_level =2;
}
$start_node = XT::getParam("node");



$result = XT::query("SELECT main.id, main.pid, details.title, details.ext_link, details.target, floor(( main.r - main.l) / 2) AS subs, main.level - 2 as level, details.active, main.l, main.r,details.rewrite_name
                FROM
                    " . $GLOBALS['plugin']->getTable("navigation") . " AS main LEFT JOIN
                    " . $GLOBALS['plugin']->getTable("navigation_details") . " AS details ON (details.node_id = main.ID AND details.lang = '" . XT::getLang() . "'),
                " . $GLOBALS['plugin']->getTable("navigation") . " AS n2
                WHERE
                    n2.id ='" . $start_node . "'
                    AND main.l <= n2.l
                    AND main.r >= n2.r
                    AND main.level = " . $start_level . "
                GROUP BY
                    main.l
                ORDER BY main.l
            ",__FILE__,__LINE__,0);
$data = array();
while ($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("NAV", $data[0]);
$content = XT::build($style);
?>
