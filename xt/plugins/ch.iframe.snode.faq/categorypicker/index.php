<?php
require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title','active','public');
$treewidget->buildTree('faq_tree','faq_tree_details','%s','',$in);

$data = $treewidget->getData();
$nodes = array();
foreach($data as $key => $node){
    $nodes[] = $node['id'];
}

$result = XT::query("SELECT * FROM " . XT::getTable('faq2cat') . " 
WHERE 
    faq_id = " . XT::getParam('cid') . ""
,__FILE__,__LINE__,0);

$row = $result->FetchRow();

XT::assign("SELECTED", $row);

XT::assign("CTITLE", $_REQUEST['ctitle']);
XT::assign("CTYPE", $_REQUEST['ctype']);
XT::assign("CID", $_REQUEST['cid']);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());


$content = XT::build("tree.tpl");

?>