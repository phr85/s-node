<?php

$GLOBALS['plugin']->contribute('edit_buttons','Save', 'saveFile','disk_blue.png','0','');
$GLOBALS['plugin']->contribute('edit_buttons','Recalculate Image', 'recalculateImage','refresh.png','0','');
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$result = XT::query("
    SELECT
        a.id,
        det.title,
        a.filename,
        a.filesize,
        a.upload_date,
        det.description,
        det.keywords,
        a.type,
        a.width,
        a.height,
        b.username,
        a.public,
        a.image,
        a.image_version,
        a.count_downloads,
        a.downloads,
        d.type as image_type,
		a.md5sum,
		a.manual_date,
		a.valid_date,
		a.valid_from
    FROM
        " . $GLOBALS['plugin']->getTable("files") . " as a
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_details") . " as det ON (a.id = det.id AND det.lang = '" . XT::getPluginLang() .  "')
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("user") . " as b ON (a.upload_user = b.id)
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files") . " as d ON (a.image = b.id)
    WHERE
        a.id = " . $GLOBALS['plugin']->getValue("file_id") . "
    ",__FILE__,__LINE__);

include_once(INCLUDE_DIR . 'mimetypes.inc.php');
if(!function_exists("mime_content_type_xt")){
    function mime_content_type_xt($filename){
        return $GLOBALS['mimetypes'][substr(strrchr(strtolower($filename), '.'),1)];
    }
}

$data = array();
while($row = $result->FetchRow()){
    $row['mime'] = mime_content_type_xt($row['filename']);
    $data[] = $row;
}

 $data[0]['valid_from_hrs'] = date("H",$data[0]['valid_from']);
 $data[0]['valid_from_min'] = date("i",$data[0]['valid_from']);
XT::assign("FILE",$data[0]);
XT::assign("TIME", TIME);

$content = XT::build("editFile.tpl");

?>
