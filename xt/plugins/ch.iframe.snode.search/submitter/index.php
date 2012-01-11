<?php

// Get content types
$result = XT::query("
    SELECT
        id,
        title
    FROM
        " . $GLOBALS['plugin']->getTable("content_types") . "
    ORDER BY
        title ASC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("CONTENT_TYPES", $data);


// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);
?>