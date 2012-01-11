<?php
// Get available languages
$result = XT::query("
    SELECT
        id,
        title
    FROM " . $GLOBALS['plugin']->getTable("languages") . "
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("LANGS", $data);

$content = XT::build("default.tpl");

?>
