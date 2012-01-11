<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title','active','public');
$count = $treewidget->buildTree('newsmanager_tree','newsmanager_tree_details','%s','',$in);
$data = $treewidget->getData();

if(XT::getPermission('add')){
    
    // Add Buttons
    if(XT::getPermission('add')){
        if(XT::getSessionValue('ctrl_add') || 
        XT::getSessionValue('ctrl_cut') || 
        XT::getSessionValue('ctrl_copy') || 
        XT::getSessionValue('ctrl_copy_entry') || 
        XT::getSessionValue('ctrl_cut_entry')){
            $GLOBALS['plugin']->contribute('overview_buttons','Cancel', 'ctrlCancel','delete.png','1','master');
        } else {
            (sizeof($count) > 0) ? $GLOBALS['plugin']->contribute('overview_buttons','Add category', 'addNode','folder_new.png','1','master') : $GLOBALS['plugin']->contribute('overview_buttons','Add page', 'addFirstPage','document_new.png','1','master');;
        }
    }
    
    // Buttons
    $GLOBALS['plugin']->contribute('overview_buttons','Add news', 'addNewsRel','document_new.png','0','slave1');

    XT::assign("CTRL", 
    XT::getSessionValue('ctrl_add') | 
    XT::getSessionValue('ctrl_cut') | 
    XT::getSessionValue('ctrl_copy')|
    XT::getSessionValue('ctrl_copy_entry')|
    XT::getSessionValue('ctrl_cut_entry')
     );
    XT::assign("CTRLENTRY", 
    XT::getSessionValue('ctrl_copy_entry')|
    XT::getSessionValue('ctrl_cut_entry')
    );
     
    if($GLOBALS['plugin']->getSessionValue('ctrl_add')){
        XT::assign("CTRL_TARGET","slave1");
        XT::assign("CTRL_FORM","0");
    } else {
        XT::assign("CTRL_TARGET","master");
        XT::assign("CTRL_FORM","1");
    }
}

$nodes = array();
foreach($data as $key => $node){
    $nodes[] = $node['id'];
}

// SQL
$result = XT::query("
    SELECT
        a.title,
        a.subtitle,
        a.creation_date,
        a.active,
        a.locked,
        a.locked_user,
        a.locked_date,
        a.published,
        a.rid,
        rel.node_id,
        rel.news_id as id
    FROM
        " . XT::getTable('newsmanager_tree_rel') . " as rel LEFT JOIN 
        " . XT::getTable('newsmanager_v') . " as a ON (a.id = rel.news_id AND a.latest = 1 AND a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
    WHERE
        rel.node_id IN (" . implode(',',$nodes) . ")
    ORDER BY
        a.creation_date DESC
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $row['title'] = date('d.m H:i',$row['creation_date']) . ' ' . $row['title'];
    $data[$row['node_id']][] = $row;
}
XT::assign("NEWS", $data);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build("overview.tpl");
?>