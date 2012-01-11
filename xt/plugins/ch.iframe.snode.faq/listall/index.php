<?php

// Limit 
if(is_numeric(XT::getParam('limit'))){
    $limit = " LIMIT 1," . intval(XT::getParam('limit'));
}else{
    $limit = null;
}

// Get all FAQ items
$result = XT::query("
    SELECT
        faq.*
    FROM 
        " . XT::getTable("faq") . " as faq
    INNER JOIN
        " . XT::getTable("faq2cat") . " as rel on (faq.id = rel.faq_id)
    WHERE
        faq.active = 1 AND
        rel.node_id != 2
        " . $limit . "
",__FILE__,__LINE__,0);

$temp = XT::getQueryData($result);

XT::assign("xt" . XT::getBaseID() . "_items",$temp);

$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';
$content = XT::build($style);

?>