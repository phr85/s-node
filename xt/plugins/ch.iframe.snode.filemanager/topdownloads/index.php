<?php

// Parameter :: category
$category = XT::getParam("category") != '' ? XT::getParam("category") : 1;

// Parameter :: count
$count = XT::getParam("count") != '' ? XT::getParam("count") : 5;

// Parameter :: image_version
$version = XT::getParam("image_version") != '' ? XT::getParam("image_version") : 1;

// Parameter :: width
$min_width = XT::getParam("min_width") != '' ? XT::getParam("min_width") : 0;

$additional = '';
// Build query additionals
if($min_width > 0){
    $additional .= " AND f.width > " . $min_width . " ";
}

// Limit
$limit = '';
if($count > 0){
    $limit = ' LIMIT ' . $count;
}

// Get files for the active folder
$result = XT::query("
    SELECT
        det.title,
        f.id,
        f.filesize,
        f.filename,
        det.description,
        f.downloads
    FROM
        " . XT::getTable("files_tree") . " as tree,
        " . XT::getTable("files_tree") . " as tree2,
        " . XT::getTable("files_rel") . " as rel LEFT JOIN
        " . XT::getTable("files") . " as f ON (f.id = rel.file_id)
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_details") . " as det ON (rel.file_id = det.id AND det.lang = '" . XT::getLang() .  "') 
    WHERE
        tree2.id IN (" . $category . ") AND
        tree.l >= tree2.l AND 
        tree.r <= tree2.r AND
        rel.node_id = tree.id
        " . $additional . "
    GROUP BY
        f.id
    ORDER BY
        f.downloads DESC
    " . $limit . "
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("COUNT", $count);
XT::assign("VERSION", $version);
XT::assign("FILES", $data);

$content = XT::build('default.tpl');

?>