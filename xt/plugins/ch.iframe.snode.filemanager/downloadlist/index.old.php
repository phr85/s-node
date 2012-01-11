<?php

// Parameter :: category
$category = XT::getParam("category") != '' ? XT::getParam("category") : 1;

// Parameter :: count
$count = XT::getParam("count") != '' ? XT::getParam("count") : 0;

// Parameter :: image_version
$version = XT::getParam("image_version") != '' ? XT::getParam("image_version") : 1;

// Parameter :: min width
$min_width = XT::getParam("min_width") != '' ? XT::getParam("min_width") : 0;

// Parameter :: style
$style = XT::getParam("style") != '' ? XT::getParam("style") : 'default.tpl';

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
// Get the tree
$result = XT::query("SELECT nodes.node_id, nodes.title, tree.pid, tree.level, nodes.description
FROM
 " . XT::getTable("files_tree") . " as tree,
 " . XT::getTable("files_tree") . " as tree2
 LEFT JOIN
   " . XT::getTable("files_tree_details") . " as nodes ON(tree.id = nodes.node_id AND nodes.lang = '" . XT::getLang() .  "')
WHERE
tree2.id IN (" . $category . ") AND
        tree.l >= tree2.l 
    AND 
        tree.r <= tree2.r 
        
ORDER by tree.l
",__FILE__,__LINE__);

XT::assign("TREE",XT::getQueryData($result));

// Get files for the active folder
$result = XT::query("
    SELECT
        det.title,
        nodes.description as folderdescription,
        f.id,
        f.filesize,
        f.filename,
        det.description,
        f.image,
        nodes.node_id,
        nodes.title as nodetitle,
        f.type
    FROM
        " . XT::getTable("files_tree") . " as tree,
        " . XT::getTable("files_tree") . " as tree2,
        " . XT::getTable("files_rel") . " as rel
    LEFT JOIN
        " . XT::getTable("files") . " as f ON (f.id = rel.file_id)
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_details") . " as det ON (rel.file_id = det.id AND det.lang = '" . XT::getLang() .  "') ,
        " . XT::getTable("files_tree_details") . " as nodes
    WHERE
        tree2.id IN (" . $category . ") AND
        tree.l >= tree2.l 
    AND 
        tree.r <= tree2.r 
    AND
        rel.node_id = tree.id
    AND 
        nodes.node_id = tree.id 
    AND 
        nodes.lang = '" . XT::getLang() .  "'
        " . $additional . "

    ORDER BY
        nodes.title ASC,
        det.title ASC
    " . $limit . "
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[$row['node_id']]['data'][] = $row;
    $data[$row['node_id']]['title'] = $row['nodetitle'];
    $data[$row['node_id']]['description'] = $row['folderdescription'];
    $files[] = $row;
}

XT::assign("VERSION", $version);
XT::assign("FILES", $files);
XT::assign("DATA", $data);


$content = XT::build($style);

?>