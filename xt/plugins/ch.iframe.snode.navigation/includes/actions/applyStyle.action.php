<?php

XT::call('savePage');

// Get all subentries
$result = XT::query("
    SELECT
        b.id
    FROM 
        " . XT::getTable('navigation') . " as a LEFT JOIN
        " . XT::getTable('navigation') . " as b ON (b.l > a.l AND b.r < a.r)
    WHERE
        a.id = " . XT::getValue('node_id') . "
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row['id'];
}
$node_in = implode(',', $data);
if($node_in != ""){
    XT::query("
        UPDATE
            " . XT::getTable('navigation_details') . "
        SET
            header = '" . XT::getValue('header') . "',
            footer = '" . XT::getValue('footer') . "',
            css = '" . XT::getValue('css') . "'
            WHERE
            node_id IN (" . $node_in . ")
        AND 
            lang = '" . XT::getPluginLang() . "'
    ",__FILE__,__LINE__);
}

?>