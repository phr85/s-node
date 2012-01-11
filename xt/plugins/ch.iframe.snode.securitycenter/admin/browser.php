<?php

$GLOBALS['plugin']->contribute('browser_buttons','Add file', 'addFile','','0','slave1');

if($GLOBALS['plugin']->getValue("open") == ''){
    is_numeric($GLOBALS['plugin']->getSessionValue("open")) ? $GLOBALS['plugin']->setValue("open", $GLOBALS['plugin']->getSessionValue("open")) : $GLOBALS['plugin']->setValue("open",1);
}

// Get subfolders
$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("pools") . " as a LEFT JOIN
        " . $GLOBALS['plugin']->getTable("pools_details") . " as b ON (b.node_id = a.id AND b.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
    WHERE
        a.pid = '" . $GLOBALS['plugin']->getValue("open") . "'
    ORDER BY
        a.l ASC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("FOLDERS", $data);
/*
// Get files
$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("pools_rel") . " as a LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files") . " as b ON (b.id = a.file_id)
    WHERE
        a.node_id = '" . $GLOBALS['plugin']->getValue("open") . "'
    ORDER BY
        b.title ASC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("FILES", $data);
*/

XT::assign("OPEN", $GLOBALS['plugin']->getValue("open"));

$content = XT::build("browser.tpl");

?>
