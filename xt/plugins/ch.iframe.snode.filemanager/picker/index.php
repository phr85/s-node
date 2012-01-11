<?php

$style = $GLOBALS['plugin']->getParam("style") !='' ? $GLOBALS['plugin']->getParam("style") : "default.tpl";

// Handle order requests
if(XT::getValue("order_by") != ''){
    XT::setSessionValue("order_by", XT::getValue("order_by"));
}
 if(XT::getValue("order_by_dir") != ''){
    XT::setSessionValue("order_by_dir", XT::getValue("order_by_dir"));
}
if (XT::getSessionValue('order_by') == '') {
	XT::setSessionValue('order_by','det.title');	
}
if (XT::getSessionValue('order_by_dir') == '') {
	XT::setSessionValue('order_by_dir','ASC');	
}
$order_by = XT::getSessionValue('order_by') . ' ' . XT::getSessionValue('order_by_dir');

if (!XT::getSessionValue('ctrl_add')){
	XT::addImageButton('Add folder','addNode','default','folder_new.png','picker');
} else {
	XT::addImageButton('Cancel','ctrlCancel','default','cancel.png','picker');
}

require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->fix_tree = 1;
$treewidget->addDetails('title','active');
$count = $treewidget->buildTree('files_tree','files_tree_details','%s','',$in);

if($GLOBALS['plugin']->getValue("open") != ''){
    $GLOBALS['plugin']->setSessionValue("open", $GLOBALS['plugin']->getValue("open"));
}

// Get files
$result = XT::query("
    SELECT
        b.id,
        b.filename,
        det.title,
        b.type
    FROM
        " . $GLOBALS['plugin']->getTable("files_rel") . " as a 
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files") . " as b ON (b.id = a.file_id)
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_details") . " as det ON (b.id = det.id AND det.lang = '" . XT::getPluginLang() .  "') 
    WHERE
        a.node_id = '" . $GLOBALS['plugin']->getSessionValue("open") . "' 
    AND
        (b.type= 1 OR b.type= 2)
    ORDER BY
        " . $order_by . "
",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("FILES", $data);


if($GLOBALS['plugin']->getValue("file_id") != ''){
    // Get files
    $result = XT::query("
        SELECT
            a.*,
            det.description,
            det.title,
			det.keywords
        FROM
            " . $GLOBALS['plugin']->getTable("files") . " as a
        LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_details") . " as det ON (a.id = det.id AND det.lang = '" . XT::getPluginLang() .  "') 
    
        WHERE
            a.id = '" . $GLOBALS['plugin']->getValue("file_id") . "'
    ",__FILE__,__LINE__);

    $data = array();
    while($row = $result->FetchRow()){
        $data[] = $row;
    }

    XT::assign("SELECTED", $data[0]);
}

$result = XT::query("
    SELECT
        node_id,
        title,
        description,
        active,
        image,
        image_version
    FROM
        " . $GLOBALS['plugin']->getTable("files_tree_details") . "
    WHERE
        node_id = " . XT::getSessionValue("open")  . "
        AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    ",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}


XT::assign("ANODE", $data[0]);

if($GLOBALS['plugin']->getValue("form") != ''){
    $GLOBALS['plugin']->setSessionValue('form',$GLOBALS['plugin']->getValue("form"));
}

if($GLOBALS['plugin']->getValue("field") != ''){
    $GLOBALS['plugin']->setSessionValue('field',$GLOBALS['plugin']->getValue("field"));
}

XT::assign("PICKER_FORM", $GLOBALS['plugin']->getSessionValue("form"));
XT::assign("PICKER_FIELD", $GLOBALS['plugin']->getSessionValue("field"));

XT::assign("ORDER_BY_DIR", XT::getSessionValue('order_by_dir'));
XT::assign("ORDER_BY", XT::getSessionValue('order_by'));

XT::assign("CTRL",XT::getSessionValue('ctrl_add'));

XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build($style);

?>
