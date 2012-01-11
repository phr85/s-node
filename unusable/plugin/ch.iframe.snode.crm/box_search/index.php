<?php

$result = XT::query("
    SELECT
        a.title,
        a.id,
        b.title as addon
    FROM
        " . XT::getTable('addresses') . " as a LEFT JOIN
        " . XT::getTable('addresses') . " as b ON (b.id = a.organization)
    ORDER BY 
        title ASC
    LIMIT 10
");

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("ADDRESSES", $data);

$content = XT::build('default.tpl');

?>