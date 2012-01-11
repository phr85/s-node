<?php

// Parameter :: Style (string  => default is default.tpl)
$style = XT::getParam("style") !='' ? XT::getParam("style") : "default.tpl";

// Parameter :: Count (int  => default is 5)
$count = XT::getParam("count") !='' ? XT::getParam("count") : 5;

// Parameter :: Gallery (int  => default is no gallery)
$gallery_id = XT::getParam("gallery_id") !='' ? XT::getParam("gallery_id") : 0;

// Parameter :: Gallery Template (string)
$gallery_tpl = XT::getParam("gallery_tpl") !='' ? XT::getParam("gallery_tpl") : 0;

// Category addon
if($gallery_id > 0){
    $additional = 'WHERE rel.gallery_id = ' . $gallery_id;
}

// Get top images
$result = XT::query("
    SELECT
        rel.description,
        rel.title,
        rel.views,
        rel.pos,
        f.id,
        f.title as file_title,
        f.description as file_description,
        rel.gallery_id,
        rel.file_id
    FROM
        " . XT::getTable('galleries_rel') . " as rel LEFT JOIN
        " . XT::getTable('files_details') . " as f ON (f.id = rel.file_id AND f.lang='" . XT::getLang() . "')
        " . $additional . "
    GROUP BY
        rel.file_id
    ORDER BY
        rel.views DESC
    LIMIT " . $count . "
",__FILE__,__LINE__);

$images = array();
while($row = $result->FetchRow()){
    
    // If gallery image relation title is empty, use file title
    if($row['title'] == ''){
        $row['title'] = $row['file_title'];
    }
    
    // If gallery image relation description is empty, use file description
    if($row['description'] == ''){
        $row['description'] = $row['file_description'];
    }
    
    $images[] = $row;
}

// Assign images
XT::assign("IMAGES", $images);

// Assign Gallery template
XT::assign("GALLERY_TPL", $gallery_tpl);

// Assign count
XT::assign("COUNT", $count);
        
// Get content
$content = XT::build($style);

?>