<?php

$GLOBALS['plugin']->contribute('view_buttons','Add relation', 'addRelation','link_add.png','view','');

$result = XT::query("
    SELECT
        a.id,
        det.title,
        a.filesize,
        a.upload_date,
        det.description,
        det.keywords,
        a.type,
        a.width,
        a.height,
        b.username,
        b.firstName,
        b.lastName
    FROM
        " . $GLOBALS['plugin']->getTable("files") . " as a 
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_details") . " as det ON (a.id = det.id AND det.lang = '" . XT::getPluginLang() .  "') 
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("user") . " as b ON (b.id = a.upload_user)
    WHERE
        a.id = " . $GLOBALS['plugin']->getValue("file_id") . "
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}
XT::assign("FILE",$data[0]);


if($data[0]['type'] == 3){
    // Header ("Content-type: image/gif");
    $im = imagecreatetruecolor(400, 45);
    $white = ImageColorAllocate ($im, 255, 255, 255);
    imagefilledrectangle($im,0,0,400,45,$white);
    $black = ImageColorAllocate ($im, 0, 0, 0);
    ImageTTFText ($im, 16, 0, 1, 20, $black, $GLOBALS['plugin']->getConfig('file_upload_dir') . $data[0]['id'],
                 "S-Node XT Framework");
    ImageTTFText ($im, 10, 0, 1, 40, $black, $GLOBALS['plugin']->getConfig('file_upload_dir') . $data[0]['id'],
                 "S-Node XT Framework");
    ImagePng ($im,"tmp.png");
    ImageDestroy ($im);
}

// Get relation data
$result = XT::query("
    SELECT
        a.content_id,
        a.content_type,
        a.target_content_id,
        a.target_content_type,
        b.title,
        c.title as content_type_title,
        c.icon
    FROM
        " . $GLOBALS['plugin']->getTable("relations") . " as a LEFT JOIN
        " . $GLOBALS['plugin']->getTable("search_infos_global") . "_" . $GLOBALS['plugin']->getActiveLang() . " as b ON (b.content_id = a.target_content_id AND b.content_type = a.target_content_type),
        " . $GLOBALS['plugin']->getTable("content_types") . " as c
    WHERE
        a.content_id = " . $GLOBALS['plugin']->getValue("file_id") . "
        AND a.content_type = " . $GLOBALS['plugin']->getContentType("File") . "
        AND c.id = a.target_content_type
    ORDER BY
        c.id DESC
    ",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("RELATIONS",$data);
XT::assign("TIME", TIME);

$content = XT::build("viewFile.tpl");

?>
