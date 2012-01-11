<?php
require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title','active','public');
$treewidget->buildTree('files_tree','files_tree_details','%s','',$in);

$data = $treewidget->getData();
$nodes = array();
foreach($data as $key => $node){
    $nodes[] = $node['id'];
}
$in = implode(", " ,$nodes);
$result = XT::query("SELECT * FROM " . XT::getTable('relations') . " 
WHERE 
    content_type=" . XT::getContentType('Filefolder') . " 
AND 
    target_content_type=" . $_REQUEST['ctype'] . " 
AND 
    content_id in(0," . $in . " )
AND 
    target_content_id=" . $_REQUEST['cid']
,__FILE__,__LINE__,0);

while($row = $result->FetchRow()){
    $selected[$row['content_id']] = true;
}
XT::assign("SELECTED", $selected);

XT::assign("CTITLE", $_REQUEST['ctitle']);
XT::assign("CTYPE", $_REQUEST['ctype']);
XT::assign("CID", $_REQUEST['cid']);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());


$content = XT::build("tree.tpl");

?>