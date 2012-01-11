<?php

// Handle order requests
if(XT::getValue("order_by") != ''){
    XT::setSessionValue("order_by", XT::getValue("order_by"));
}
if(XT::getValue("order_by_dir") != ''){
    XT::setSessionValue("order_by_dir", XT::getValue("order_by_dir"));
}
if(XT::getSessionValue('order_by') != '' && XT::getSessionValue('order_by_dir') != ''){
    $order_by = XT::getSessionValue('order_by') . ' ' . XT::getSessionValue('order_by_dir');
} else {
    $order_by = 'det.title ASC';
    XT::setSessionValue('order_by','det.title');
    XT::setSessionValue('order_by_dir','asc');
    XT::setSessionValue('folder_order_by','b.title');
}


$GLOBALS['plugin']->contribute('browser_buttons','Add file', 'addFile','document_add.png','0','slave1');

if($GLOBALS['plugin']->getValue("open") == ''){
    is_numeric($GLOBALS['plugin']->getSessionValue("open")) ? $GLOBALS['plugin']->setValue("open", $GLOBALS['plugin']->getSessionValue("open")) : $GLOBALS['plugin']->setValue("open",1);
}

// Get subfolders
$result = XT::query("
    SELECT
        b.title,
        a.id,
        a.pid
    FROM
        " . $GLOBALS['plugin']->getTable("files_tree") . " as a LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_tree_details") . " as b ON (b.node_id = a.id AND b.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
    WHERE
        a.pid = '" . $GLOBALS['plugin']->getValue("open") . "' AND
        b.title != ''
    ORDER BY
        b.title " . XT::getSessionValue('order_by_dir'),__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("FOLDERS", $data);

// Get files
$result = XT::query("
    SELECT
        det.title,
        b.filename,
        b.id,
        b.filesize,
        b.type,
        b.upload_date
    FROM
        " . $GLOBALS['plugin']->getTable("files_rel") . " as a
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files") . " as b ON (b.id = a.file_id)
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_details") . " as det ON (b.id = det.id AND det.lang = '" . XT::getPluginLang() .  "')

    WHERE
        a.node_id = '" . $GLOBALS['plugin']->getValue("open") . "'
    ORDER BY
        " . $order_by  . "
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

// Get subfolders
$result = XT::query("
    SELECT
        pid
    FROM
        " . $GLOBALS['plugin']->getTable("files_tree") . "
    WHERE
        id = '" . $GLOBALS['plugin']->getValue("open") . "'
",__FILE__,__LINE__);

$pid = 1;
while($row = $result->FetchRow()){
    $pid = $row['pid'];
}

XT::assign("CTRL", $GLOBALS['plugin']->getSessionValue('ctrl_add') | $GLOBALS['plugin']->getSessionValue('ctrl_cut')| $GLOBALS['plugin']->getSessionValue('ctrl_cut_file') | $GLOBALS['plugin']->getSessionValue('ctrl_copy'));
XT::assign("FILES", $data);
XT::assign("OPEN_PID", $pid);
XT::assign("OPEN", $GLOBALS['plugin']->getValue("open"));
XT::assign("ORDER_BY_DIR", XT::getSessionValue('order_by_dir'));
XT::assign("ORDER_BY", XT::getSessionValue('order_by'));
$content = XT::build("browser.tpl");

?>
