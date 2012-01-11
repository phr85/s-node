<?php

$result = XT::query("
    SELECT
        a.id,
        a.status,
        a.start_date,
        a.duration,
        b.title,
        c.title as addon
    FROM
        " . XT::getTable('contacts') . " as a LEFT JOIN 
        " . XT::getTable('addresses') . " as b ON (b.id = a.address_id) LEFT JOIN
        " . XT::getTable('addresses') . " as c ON (c.id = b.organization)
    ORDER BY 
        title ASC
    LIMIT 10
");

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("CONTACTS", $data);

$content = XT::build('default.tpl');

?>