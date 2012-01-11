<?php
XT::assign('FORM',$GLOBALS['plugin']->getSessionValue("form"));
XT::assign('FIELD',$GLOBALS['plugin']->getSessionValue("field"));
XT::assign('TITLEFIELD',$GLOBALS['plugin']->getSessionValue("titlefield"));
XT::assign('MODE',$GLOBALS['plugin']->getSessionValue("mode"));

$sequence = substr(XT::getSessionValue('selection'),0,-1);

if($sequence != ""){
    $result = XT::query("SELECT
        d.node_id,
        d.title,
        d.creation_date,
        d.active
    FROM
        " . XT::getTable('articles_tree_details') . " as d
    WHERE
        d.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    AND
        d.node_id IN (" . $sequence . ")
    ORDER BY
        d.title ASC
    ",__FILE__,__LINE__);
XT::assign('CATEGORIES', XT::getQueryData($result));
}

XT::assign('SEQUENCE',$sequence);

$content = XT::build("slave.tpl");
?>