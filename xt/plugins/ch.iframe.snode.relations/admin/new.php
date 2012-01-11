<?php
$GLOBALS['plugin']->contribute("edit_buttons", "Save", "saveRelation","disk_blue.png","0","");

$content_type =  XT::getValue("content_type") != false ? XT::getValue("content_type") : 0;
$target_content_type =  XT::getValue("target_content_type") != false ? XT::getValue("target_content_type") : 0;



$result = XT::query("SELECT ct.id, ct.title , cp.template
FROM 
    " .XT::getTable("content_types") . " as ct, 
    " . XT::getTable("pickers") . " cp
WHERE 
    cp.content_type = ct.id  
",__FILE__,__LINE__);

$content_types = XT::getQueryData($result);


// Get picker info
$result = XT::query("
    SELECT
        id,
        id as value,
        template
    FROM
        " . XT::getTable("pickers") . "
    WHERE
        is_main=1
    AND
        content_type = " . $content_type
,__FILE__,__LINE__,1);

$picker = $result->fetchRow();
$picker['titlevalue'] = $relation['title'];

// Get picker info
$result = XT::query("
    SELECT
        id,
        id as value,
        template
    FROM
        " . XT::getTable("pickers") . "
    WHERE
        is_main=1
    AND
        content_type = " . $target_content_type
,__FILE__,__LINE__);

$target_picker = $result->fetchRow();
$target_picker['titlevalue'] = $relation['target_title'];


// Check for changed content
$picker['value'] = XT::getValue("content_id") != "" ? XT::getValue("content_id") : $picker['value'];
$picker['titlevalue'] = XT::getValue("content_id_title") != "" ? XT::getValue("content_id_title") : $picker['titlevalue'];

// Check for changed content
$target_picker['value'] = XT::getValue("target_content_id") != "" ? XT::getValue("target_content_id") : $target_picker['value'];
$target_picker['titlevalue'] = XT::getValue("target_content_id_title") != "" ? XT::getValue("target_content_id_title") : $target_picker['titlevalue'];


XT::assign("CTYPES", $content_types);
XT::assign("TARGET_CONTENT_TYPE", $target_content_type);
XT::assign("CONTENT_TYPE", $content_type);

XT::assign("PICKER", $picker);
XT::assign("TARGET_PICKER", $target_picker);

$content = XT::build("new.tpl");
?>