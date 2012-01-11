<?php


require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title','active');
$treewidget->setOpenField('openfolder');
$count = $treewidget->buildTree('files_tree','files_tree_details','%s','',$in);
if (XT::getValue("livetpl") == 1) {
	XT::addImageButton('Close','close','default','exit.png','0','');
} else {
	XT::addImageButton('Close','close','default','exit.png','0','slave1');
}
XT::assign("OPEN", $GLOBALS['plugin']->getSessionValue('openfolder'));
XT::assign("OPEN_GALLERY", $GLOBALS['plugin']->getSessionValue('open'));
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

// Get files
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable("files_rel") . " as a LEFT JOIN
        " . XT::getTable("files") . " as b ON (b.id = a.file_id)
    WHERE
        a.node_id = '" . $GLOBALS['plugin']->getSessionValue('openfolder') . "'
        AND b.type = 1
    ORDER BY
        b.id ASC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("FILES", $data);

// Get already assigned folders
$result = XT::query("
    SELECT
        folder_id
    FROM 
        " . XT::getTable('galleries_folder_rel') . "
    WHERE
        gallery_id = '" . XT::getSessionValue('open') . "' AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);

$rel_folders = array();
while($row = $result->FetchRow()){
    $rel_folders[$row['folder_id']] = true;
}

XT::assign("REL_FOLDERS", $rel_folders);

// Get already assigned images
$result = XT::query("
    SELECT
        file_id,
        pos
    FROM 
        " . XT::getTable('galleries_rel') . "
    WHERE
        gallery_id = '" . XT::getSessionValue('open') . "' AND
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);

$rel_files = array();
while($row = $result->FetchRow()){
    $rel_files[$row['file_id']] = true;
}
if (XT::getValue("livetpl") == 1){
	XT::assign("LIVETPL", 1);
}
XT::assign("REL_FILES", $rel_files);

$content = XT::build('addImages.tpl');

?>