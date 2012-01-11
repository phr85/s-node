<?php

require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title','active','public');
$treewidget->buildTree(XT::getParam('table_tree'),XT::getParam('table_nodes'),'%s','',$in);
$data = $treewidget->getData();
$nodes = array();
foreach($data as $key => $node){
    $nodes[] = $node['id'];
}
$in = implode(", " ,$nodes);

if(XT::getParam('table_items')!=""){

    $result = XT::query("SELECT * FROM
        " . XT::getTable(XT::getParam('table_items_relation')) . " as rel INNER JOIN
        " . XT::getTable(XT::getParam('table_items')) . " as a ON (a.id = rel." . XT::getParam('itemrelfieldname') . "  AND a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
    WHERE
        rel." . XT::getParam('noderelfieldname') . " IN (" . $in . ")
    ORDER BY
        a.title ASC
    ",__FILE__,__LINE__);

    $data = array();
    while($row = $result->FetchRow()){
        $data[$row['node_id']][] = $row;
        $items_in[] = $row['id'];
    }
    XT::assign("ITEMS", $data);

    if(is_array($items_in)){
        $result = XT::query("SELECT * FROM " . XT::getTable('relations') . "
    WHERE
        content_type=" . XT::getParam('item_ctype'). "
    AND
        target_content_type=" . $_REQUEST['ctype'] . "
    AND
        content_id in(0," . implode(", " ,$items_in) . " )
    AND
        target_content_id=" . $_REQUEST['cid'] . "
	AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'"         
        ,__FILE__,__LINE__);

        while($row = $result->FetchRow()){
            $selected[$row['content_id']] = true;
        }
        XT::assign("ITEM_SELECTED", $selected);
    }

}


$result = XT::query("SELECT * FROM " . XT::getTable('relations') . "
WHERE
     content_type=" . XT::getParam('tree_ctype'). "
AND
    target_content_type=" . $_REQUEST['ctype'] . "
AND
    content_id in(0," . $in . " )
AND
    target_content_id=" . $_REQUEST['cid'] . "
AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'"    
,__FILE__,__LINE__);

while($row = $result->FetchRow()){
    $selected[$row['content_id']] = true;
}
XT::assign("SELECTED", $selected);



XT::assign("CTITLE", $_REQUEST['ctitle']);
XT::assign("CTYPE", $_REQUEST['ctype']);
XT::assign("TREECTYPE", XT::getParam('tree_ctype'));
XT::assign("ITEMCTYPE", XT::getParam('item_ctype'));
XT::assign("CID", $_REQUEST['cid']);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());


$content = XT::build("tree.tpl");

?>