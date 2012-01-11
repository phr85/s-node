<?php

$result = XT::query("
    SELECT
        id,
        title,
        installed
    FROM
        " . $GLOBALS['plugin']->getTable("languages") . "
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("LANGS", $data);

$content = XT::build("languages.tpl");

?>
