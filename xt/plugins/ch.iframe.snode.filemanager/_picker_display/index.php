<?php
XT::assign('FORM',$GLOBALS['plugin']->getSessionValue("form"));
XT::assign('FIELD',$GLOBALS['plugin']->getSessionValue("field"));
XT::assign('TITLEFIELD',$GLOBALS['plugin']->getSessionValue("titlefield"));
XT::assign('MODE',$GLOBALS['plugin']->getSessionValue("mode"));

$GLOBALS['plugin']->contribute('browser_buttons','Add file', 'addFile','document_add.png','0','slave1');

if($GLOBALS['plugin']->getValue("open") == ''){
    is_numeric($GLOBALS['plugin']->getSessionValue("open")) ? $GLOBALS['plugin']->setValue("open", $GLOBALS['plugin']->getSessionValue("open")) : $GLOBALS['plugin']->setValue("open",1);
}

// Get subfolders
$result = XT::query("
    SELECT
       *
    FROM
        " . $GLOBALS['plugin']->getTable("files_tree") . " as a LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_tree_details") . " as b ON (b.node_id = a.id AND b.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
    WHERE
        a.pid = '" . $GLOBALS['plugin']->getValue("open") . "' AND
        b.title != ''
    ORDER BY
        a.l ASC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("FOLDERS", $data);

// Get files
$result = XT::query("
    SELECT
        b.id,
        b.filename,
        b.type,
        b.width,
        b.height,
        b.image,
        b.image_version,
        b.filesize,
        b.upload_date,
        b.upload_user,
        b.downloads,
        b.count_downloads,
        det.title,
        det.description
    FROM
        " . $GLOBALS['plugin']->getTable("files_rel") . " as a 
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files") . " as b ON (b.id = a.file_id)
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_details") . " as det ON (det.id = a.file_id and det.lang='" . XT::getPluginLang() . "')
    WHERE
        a.node_id = '" . $GLOBALS['plugin']->getValue("open") . "'
    ORDER BY
        b.filename ASC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("FILES", $data);

XT::assign("OPEN", $GLOBALS['plugin']->getValue("open"));

$content = XT::build("browser.tpl");

?>
