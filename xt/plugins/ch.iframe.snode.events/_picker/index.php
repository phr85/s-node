<?php
$form = $_GET['form'] == "" ? XT::getSessionValue("form") : $_GET['form'];
$field = $_GET['field'] == "" ? XT::getSessionValue("field") : $_GET['field'];
$titlefield = $_GET['titlefield'] == "" ? XT::getSessionValue("titlefield") : $_GET['titlefield'];

XT::setSessionValue("form", $form);
XT::setSessionValue("field", $field);
XT::setSessionValue("titlefield", $titlefield);

XT::assign('FORM', $form);
XT::assign('FIELD', $field);
XT::assign('TITLEFIELD', $titlefield);

require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title','active','public');
$count = $treewidget->buildTree('events_tree','events_tree_details','%s','',$in);
$data = $treewidget->getData();

$nodes = array();
foreach($data as $key => $node){
    $nodes[] = $node['id'];
}
// SQL
$result = XT::query("
    SELECT
        events.id,
        events_details.title,
        events_details.active,
        events_details.introduction,
        events_tree_rel.node_id,
        regs.address_id as registrations
    FROM
        " . XT::getTable("events") . " AS events LEFT JOIN 
        " . XT::getTable("events_details") . " AS events_details ON (events.id = events_details.id AND events_details.lang='" . XT::getPluginLang() . "') LEFT JOIN
        " . XT::getTable("events_tree_rel") . " AS events_tree_rel ON (events.id=events_tree_rel.event_id) LEFT JOIN
        " . XT::getTable("events_registrations") . " AS regs ON (events.id=regs.event_id)
    WHERE
        events_tree_rel.node_id IN (" . implode(',',$nodes) . ") AND
        events_details.id IS NOT NULL
    GROUP BY
	    events.id
    ORDER BY
        events_details.title ASC
    ",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[$row['node_id']][] = $row;
}
XT::assign("EVENTS", $data);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build("tree.tpl");
?>