<?php

if($GLOBALS['plugin']->getValue("node_id") != ''){
    $GLOBALS['plugin']->setSessionValue("open", $GLOBALS['plugin']->getValue("node_id"));
}
if (XT::getValue("livetpl") == 1) {
	XT::addImageButton('Save','saveNode','default','save.png','0','','s','','opener.document.location.reload();');
	XT::addImageButton('Save and close','saveNodeAndClose','default','save_close.png','0','','','','opener.document.location.reload();window.close();');
	XT::addImageButton('Close','close','default','exit.png','0','','','','window.close();');
	$GLOBALS['plugin']->contribute('content_buttons','Add / Remove images','addImagesFromLive','photo_portrait.png','0','','a');
	
}else {
	XT::addImageButton('Save','saveNode','default','disk_blue.png','0','slave1','s');
	$GLOBALS['plugin']->contribute('content_buttons','Add / Remove images','addImages','photo_portrait.png','0','slave1','a');
}



XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$result = XT::query("
    SELECT
        node_id,
        title,
        description,
        active,
        image,
        image_version,
        public
    FROM
        " . XT::getTable("galleries_details") . "
    WHERE
        node_id = " . XT::getSessionValue("open") . "
        AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    ",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("NODE_ID", XT::getValue("node_id"));
XT::assign("NODE", $data[0]);

// Get already assigned images
$result = XT::query("
    SELECT
        b.id,
        fdet.title,
        fdet.description,
        b.type,
        a.active,
        a.source_folder_id,
        a.pos
    FROM 
        " . XT::getTable('galleries_rel') . " as a LEFT JOIN
        " . XT::getTable('files') . " as b ON (b.id = a.file_id) LEFT JOIN
            " . XT::getTable('files_details') . " as fdet ON (fdet.id = a.file_id AND fdet.lang ='" . XT::getLang() . "')
    WHERE
        a.gallery_id = '" . XT::getSessionValue("open") . "' AND
        a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND 
        b.type = 1
    ORDER BY
        a.pos ASC
",__FILE__,__LINE__);

$files = array();
while($row = $result->FetchRow()){
    $files[] = $row;
}

$count = sizeof($files);
if (XT::getValue("livetpl") == 1) {
	XT::assign("LIVETPL", 1);
}
XT::assign("COUNT", $count);
XT::assign("FILES", $files);
$content = XT::build("editGallery.tpl");

?>
