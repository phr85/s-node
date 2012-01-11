<?php
XT::assign('FORM',$GLOBALS['plugin']->getSessionValue("form"));
XT::assign('FIELD',$GLOBALS['plugin']->getSessionValue("field"));
XT::assign('TITLEFIELD',$GLOBALS['plugin']->getSessionValue("titlefield"));
XT::assign('MODE',$GLOBALS['plugin']->getSessionValue("mode"));


require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title','active','public');
$count = $treewidget->buildTree('files_tree','files_tree_details','%s','',$in);
$data = $treewidget->getData();

$nodes = array();
foreach($data as $key => $node){
    $nodes[] = $node['id'];
}

// SQL
$result = XT::query("
    SELECT
        a.node_id AS id,
        det.title as ftitle,
        f.filename,
        f.filesize,
        det.title,
        det.description,
        a.creation_date,
        a.active,
        rel.node_id
    FROM
        " . XT::getTable('files_rel') . " AS rel 
    LEFT JOIN
        " . XT::getTable('files_tree_details') . " AS a
            ON (a.node_id = rel.node_id AND a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "') 
    LEFT JOIN
        " . XT::getTable("files") . " as f ON (rel.file_id = f.id)
    INNER JOIN
        " . $GLOBALS['plugin']->getTable("files_details") . " as det ON (rel.file_id = det.id AND det.lang = '" . XT::getLang() .  "') 
    
        
    WHERE
        rel.node_id IN (" . implode(',',$nodes) . ")
    ORDER BY
        a.title ASC
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[$row['node_id']][] = $row;
}
XT::assign("FILES", $data);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build("tree.tpl");

?>