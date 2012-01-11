<?php

// Parameter: FAQ Item ID to be shown
$faq_id = XT::autoval("faq_id","R");

// Parameter :: Category List TPL
$list_tpl = XT::autoval("list_tpl","R");
XT::assign("xt" . XT::getBaseID() . "_category_list_tpl", $list_tpl);


/**
 * Parameter :: Style (Template)
 */
$style = XT::getParam('style') != '' ? XT::getParam('style') : "default.tpl";

/**
 * Get questions
 */
if($faq_id > 0){


    // Get Category that was selected
    $result = XT::query("
        SELECT
            *
        FROM
            " . XT::getTable("faq2cat") . " as rel
        LEFT JOIN
            " . XT::getTable('faq_tree_details') . " as tree_details ON (rel.node_id = tree_details.node_id)
        WHERE
            faq_id = ".$faq_id."
    ",__FILE__,__LINE__,0);

    while($row = $result->FetchRow()){
        $selected['id'] = $row['node_id'];
    }

    // Count view
    $result = XT::query("
        SELECT
            *
        FROM
            " . XT::getTable("faq") . " as faq
        WHERE
            faq.id = " . $faq_id . " AND
            lang = '" . XT::getLang() . "'
    ",__FILE__,__LINE__);

    $data = XT::getQueryData($result);

}

XT::assign("xt" . XT::getBaseID() . "_selected", $selected);
XT::assign("xt" . XT::getBaseID() . "_question", $data);

$content = XT::build($style);

?>