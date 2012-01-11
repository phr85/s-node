<?php

// Prepare search string
$clean_uri = $_SERVER['REQUEST_URI'];
$iPos = strpos($clean_uri,'?' . session_name());

if ($iPos > 0 ) {
    $clean_uri = substr($_SERVER['REQUEST_URI'],0,$iPos);
}

$clean_uri = str_replace('/','',$clean_uri);

// Search for matching virtual url's
$result = XT::query("
    SELECT
        url
    FROM
        " . $GLOBALS['plugin']->getTable("virtual_url") . "
    WHERE
        pattern = '" . $clean_uri . "'
    LIMIT 1
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

if(count($data) > 0){
    // Redirect to url defined by virtual entry
    header("Location: " . $data[0]['url']);
} else {
    // Redirect to search
    header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['plugin']->getConfig('search_tpl') . "&x" . $GLOBALS['plugin']->getConfig('search_baseid') . "_term=" . $clean_uri);
}

?>