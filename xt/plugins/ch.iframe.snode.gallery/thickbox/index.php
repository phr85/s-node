<?php
$data = array();
$recursive = XT::autoval("recursive","P",false);
$gallery_id = XT::autoval("id","P",1);
$data['metadata']['version'] = XT::autoval("image_version","P",6);

if($recursive){
    $recursivity = "AND n1.l >= n2.l AND n1.r <= n2.r";
}else{
    $recursivity = "AND n1.l = n2.l AND n1.r = n2.r";
}

// Get the way
$result = XT::query("
            SELECT
                n1.id,
                n1.level,
                n1.pid,
                floor(( n1.r - n1.l) / 2) AS subs,
                gdet.*
            FROM
                " . XT::getTable("galleries") . " AS n1
            LEFT JOIN
                " . XT::getTable("galleries_details") . " as gdet ON (gdet.node_id = n1.id AND gdet.lang = '" . $GLOBALS['lang']->getLang() . "'),
                " . XT::getTable("galleries") . " AS n2

            WHERE
                n2.id ='" . $gallery_id . "'
               " . $recursivity . "
               AND  floor(( n1.r - n1.l) / 2) = 0
            GROUP BY
                n1.ID
            ORDER BY
                n1.l ASC
        ",__FILE__,__LINE__);


$data['data'] = XT::getQueryData($result);



XT::assign("xt" . XT::getBaseID() . "_thickbox",$data);

// build content
$content = XT::build(XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl');
?>