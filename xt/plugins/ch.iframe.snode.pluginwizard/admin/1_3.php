<?php

$result = XT::query("SHOW TABLES");

$data = array();
while($row = $result->FetchRow()){
    $keys = array_keys($row);
    $data[] = $row[$keys[0]];
}

XT::assign("TABLES",$data);

$content = XT::build("1_3.tpl");

?>
