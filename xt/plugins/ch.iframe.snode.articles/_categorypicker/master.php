<?php
XT::assign('FORM',$GLOBALS['plugin']->getSessionValue("form"));
XT::assign('FIELD',$GLOBALS['plugin']->getSessionValue("field"));
XT::assign('TITLEFIELD',$GLOBALS['plugin']->getSessionValue("titlefield"));
XT::assign('MODE',$GLOBALS['plugin']->getSessionValue("mode"));


require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title','active','public');
$count = $treewidget->buildTree('articles_tree','articles_tree_details','%s','',$in);
$data = $treewidget->getData();

$nodes = array();
foreach($data as $key => $node){
    $nodes[] = $node['id'];
}

// SQL
$result = XT::query("
    SELECT
        a.id,
        a.title,
        a.subtitle,
        a.creation_date,
        a.active,
        a.locked,
        a.locked_user,
        a.locked_date,
        a.published,
        a.rid,
        rel.node_id
    FROM
        " . XT::getTable('articles_tree_rel') . " as rel LEFT JOIN 
        " . XT::getTable('articles_v') . " as a ON (a.id = rel.article_id AND a.latest = 1 AND a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
    WHERE
        rel.node_id IN (" . implode(',',$nodes) . ")
    ORDER BY
        a.title ASC
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[$row['node_id']][] = $row;
}
XT::assign("NEWS", $data);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build("tree.tpl");

?>