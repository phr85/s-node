<?php

// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

// Parameter :: XML
$xml = $GLOBALS['plugin']->getParam('xml') != '' ? $GLOBALS['plugin']->getParam('xml') : false;
if($xml == "true"){
    header('content-type: application/rss+xml; charset=utf-8');
}

// Parameter :: Linking
$link2details = $GLOBALS['plugin']->getParam('link2details') != '' ? $GLOBALS['plugin']->getParam('link2details') : 'no';




// order
if(XT::getParam('order')!=""){
    $order_by = "n." . XT::getParam('order');
}else {
    $order_by = "n.display_time_end ASC, n.display_time_start DESC, n.creation_date DESC";
}

// Parameter :: Target
$target_tpl = $GLOBALS['plugin']->getParam('target_tpl') != '' ? $GLOBALS['plugin']->getParam('target_tpl') : '113';

// Parameter :: Count
$count = $GLOBALS['plugin']->getParam('count') != '' ? $GLOBALS['plugin']->getParam('count') : '5';
if($GLOBALS['plugin']->getParam('ids') != ""){


    $ids = implode(",",$GLOBALS['plugin']->getParam('ids'));


    $sql = "
    SELECT
        n.id,
        n.creation_user as c_id,
        n.title,
        n.subtitle,
        n.introduction,
        n.creation_date,
        n.date,
        n.active,
        n.autor,
        n.image,
        n.image_version,
        n.image_link,
        m.description as img_description
    FROM
        " . XT::getTable('articles') . " as n LEFT JOIN
        " . XT::getTable('files_details') . " as m ON (m.id = n.image AND m.lang = '" . XT::getLang() . "')
    WHERE
        n.active = 1 AND
        n.lang = '" . XT::getLang() . "'";

    if($category != '0'){
        $sql .= " AND n.id IN (" . $ids . ") ";
    }
    $sql .= " ORDER BY
        " . $order_by . "
    LIMIT
        " . $count;



    // SQL
    $result = XT::query($sql,__FILE__,__LINE__);
    XT::assign("DATA", XT::getQueryData($result));
}

XT::assign("LINK2DETAILS", $link2details);
XT::assign("TARGET_TPL", $target_tpl);

XT::assign("ADMIN_TPL", $GLOBALS['plugin']->getConfig('admin_tpl'));

$content = XT::build($style);

?>