<?php

$data = array();

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Parameter :: recursive
$recursive = XT::getParam('recursive') != '' ? XT::getParam('recursive') : 'no';

// Parameter :: Linking
$link2details = XT::getParam('link2details') != '' ? XT::getParam('link2details') : 'no';

// Parameter :: Category
$category = XT::autoval('categories',"P",1);

// Search recursive
if ($recursive == "yes") {
    $sql = "SELECT * FROM " .  XT::getTable('faq_tree')  . " WHERE id IN (" . $category . ")";
    $result = XT::query($sql, __FILE__,__LINE__);
    while ($row = $result->fetchRow()) {
        $sql = 'SELECT DISTINCT id FROM ' . XT::getTable('faq_tree')  . ' WHERE l >= ' . $row['l'] . ' AND r <= ' . $row['r'];
        $sub_result = XT::query($sql, __FILE__, __LINE__);
        while ($sub_row = $sub_result->fetchRow()) {
            $subcategories[] = $sub_row['id'];
        }
    }
    if (is_array($subcategories)) {
        $category .= "," . implode(",",$subcategories);
    }
}

// Parameter :: Target
$target_tpl = XT::getParam('target_tpl') != '' ? XT::getParam('target_tpl') : '113';

// Parameter :: Count
$limit = XT::getParam('count') != '' ? "LIMIT " . XT::getParam('count') : 'LIMIT 5';

// order
if(XT::getParam('order')!=""){
    $order_by = "n." . XT::getParam('order');
}else {
    $order_by = "rel.position ASC";
}

if($category != '0') {

    $result = XT::query("
        SELECT
            rel.faq_id,
            tree.title,
            tree.image as nodeimage,
            tree.node_id as nodeid
        FROM
            " . XT::getTable('faq2cat') . " as rel
        INNER JOIN
            " . XT::getTable('faq_tree_details') . " as tree ON (rel.node_id = tree.node_id AND tree.lang='" . XT::getLang() . "')
        INNER JOIN
            " . XT::getTable('faq') . " as n on (rel.faq_id = n.id AND n.lang='" . XT::getLang() . "')
        WHERE
            rel.node_id IN (" . $category . ")
        AND
            n.active=1
        ORDER BY
            " . $order_by ."
            " .  $limit . "
    ", __FILE__, __LINE__);

    while ($row = $result->fetchRow()) {
        $faq_ids[] = $row['faq_id'];
        $nodedetails[$row['faq_id']] = $row;
    }
}

if (is_array($faq_ids)) {

        $sql = "
        SELECT
            n.id,
            n.title,
            n.active,
            n.date,
            n.public,
            n.is_answered,
            n.answer,
            n.questioner,
            n.answer_date,
            n.image,
            n.image_version,
            n.image_zoom,
            n.description,
            n.mod_date,
            n.mod_user,
            n.c_user,
            n.questioner_mail,
            n.answer_title,
            n.answer_name,
            n.answer_address
        FROM
            " . XT::getTable('faq') . " as n
        INNER JOIN
            " . XT::getTable('faq2cat') . " as rel on (rel.faq_id = n.id)
        WHERE
            n.active = 1 AND
            n.lang = '" . XT::getLang() . "'
            AND n.id in (" . implode(",",$faq_ids) . ")

            ORDER BY " . $order_by
         . " " .  $limit
         ;
        // SQL
        $result = XT::query($sql,__FILE__,__LINE__);
        $data['data'] = XT::getQueryData($result);
}

$data['treeselected'] = XT::getSessionValue("TREESELECTED");
$data['treeway'] = XT::getSessionValue("TREEWAY");
$data['nodedetails'] = $nodedetails;
$data['link2details'] = $link2details;
$data['target_tpl'] = $target_tpl;
$data['admin_tpl'] = $GLOBALS['plugin']->getConfig('admin_tpl');
$data['category'] = $category;

XT::assign("xt" . XT::getBaseID() . "_list", $data);

$content = XT::build($style);

?>