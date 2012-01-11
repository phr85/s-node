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

header('content-type: application/rss+xml; charset=utf-8');

// Limit
$limit = '';
if($count > 0){
    $limit = ' LIMIT ' . $count;
}else{
    $limit = ' LIMIT 0,50';
}


if(!function_exists("mime_content_type_xt")){
    function mime_content_type_xt($filename){
        include_once("xt/includes/mimetypes.inc.php");
        if (isset($GLOBALS['mimetypes'][substr(strrchr($filename, '.'),1)])){

            return $GLOBALS['mimetypes'][substr(strrchr($filename, '.'),1)];
        }else {
            return false;
        }

    }
}


// Get files for the active folder
$result = XT::query("
    SELECT
        det.title,
        f.id,
        f.filesize,
        f.filename,
        det.description,
        f.image,
        f.upload_date
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
    GROUP BY
        f.id
    ORDER BY
        f.upload_date DESC
    " . $limit . "
",__FILE__,__LINE__);

$data = array();
$i = 0;
while($row = $result->FetchRow()){
    $data[$i] = $row;
    $data[$i]['filename'] = str_replace(" ","_",$row['filename']);
    $data[$i]['mimetype'] = mime_content_type_xt($row['filename']);
    $data[$i]['extension'] = substr(strrchr($row['filename'], '.'),1);
    $data[$i]['gid'] = md5($row['filename'] . $row['upload_date']);
    $i++;
}
if(XT::getParam('use_rewrite')){
    XT::assign('USE_REWRITE',true);
}
XT::assign("VERSION", $version);
XT::assign("FILES", $data);
header('Content-Type: application/xml; charset=utf-8');
$content = XT::build($style);

?>