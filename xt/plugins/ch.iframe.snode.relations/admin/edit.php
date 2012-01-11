<?php
$GLOBALS['plugin']->contribute("edit_buttons", "Save", "saveRelation","disk_blue.png","0");
XT::addImageButton('make double relation','makeDoubleRelation','edit_buttons','refresh.png','edit','','d');

$relation_id = XT::getValue("relation_id");

// Get relation info
$result = XT::query("
    SELECT
        re.id,
        re.content_type as source_content_type,
        re.content_id as source_content_id,
        re.target_content_type,
        re.target_content_id,
        re.title,
        re.description,
        re.image,
        si_source.title as source_title,
        si_target.title as target_title,
        si_source.image as source_image,
        si_target.image as target_image
    FROM 
        " . XT::getTable("relations") ." as re
        LEFT JOIN " . XT::getDatabasePrefix() . "search_infos_global_" .  XT::getLang() . " as si_source on (si_source.content_type = re.content_type AND si_source.content_id=re.content_id)
        LEFT JOIN " . XT::getDatabasePrefix() . "search_infos_global_" .  XT::getLang() . " as si_target on (si_target.content_type = re.target_content_type AND si_target.content_id=re.target_content_id)
    WHERE
        re.id=" . $relation_id . "
    AND
        re.lang='" . XT::getLang() . "'"
,__FILE__,__LINE__);

$relation = $result->fetchRow();
// set zero values if no values are defined
$relation['source_content_type'] = $relation['source_content_type'] != "" ? $relation['source_content_type'] : 0;
$relation['target_content_type'] = $relation['target_content_type'] != "" ? $relation['target_content_type'] : 0;
$relation['source_content_id']   = $relation['source_content_id']   != "" ? $relation['source_content_id']   : 0;
$relation['target_content_id']   = $relation['target_content_id']   != "" ? $relation['target_content_id']   : 0;

// select the dropdown and pickers
$result = XT::query("SELECT ct.id, ct.title , cp.template
FROM 
    " .XT::getTable("content_types") . " as ct, 
    " . XT::getTable("pickers") . " cp
WHERE 
    cp.content_type = ct.id  
",__FILE__,__LINE__);
$content_types[$relation['source_content_type']]['id'] =  $relation['source_content_type'];
$content_types[$relation['source_content_type']]['title'] =  'no picker defined (' . $relation['source_content_type'] .')';
$content_types[$relation['target_content_type']]['id'] =  $relation['target_content_type'];
$content_types[$relation['target_content_type']]['title'] =  'no picker defined (' . $relation['target_content_type'] .')';

while ($row = $result->fetchRow()) {
    $content_types[$row['id']] = $row;
}
// set the pickers

$picker['source_template'] = $content_types[$relation['source_content_type']]['template'];
$picker['target_template'] = $content_types[$relation['target_content_type']]['template'];

XT::assign("CTYPES", $content_types);
XT::assign("RELATION",$relation);
XT::assign("PICKER", $picker);

$content = XT::build("edit.tpl");
?>