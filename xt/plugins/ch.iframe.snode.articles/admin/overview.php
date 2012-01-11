<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title','active','public');
$count = $treewidget->buildTree('articles_tree','articles_tree_details','%s','',$in);
$data = $treewidget->getData();

XT::assign("current_article",XT::autoval("id","R",0));
if(XT::getPermission('add')){

    // Add Buttons
    if(XT::getPermission('add')){
        if(XT::getSessionValue('ctrl_add') ||
        XT::getSessionValue('ctrl_cut') ||
        XT::getSessionValue('ctrl_copy') ||
        XT::getSessionValue('ctrl_copy_entry') ||
        XT::getSessionValue('ctrl_cut_entry')){
            $GLOBALS['plugin']->contribute('overview_buttons','Cancel', 'ctrlCancel','cancel.png','1','master');
        } else {
        (sizeof($count) > 0) ? $GLOBALS['plugin']->contribute('overview_buttons','Add category', 'addNode','folder_new.png','1','master') : $GLOBALS['plugin']->contribute('overview_buttons','Add page', 'addFirstPage','document_new.png','1','master');;
        }
    }

    // Buttons
    $GLOBALS['plugin']->contribute('overview_buttons','Add article', 'addArticleRel','document_new.png','0','slave1');
    $GLOBALS['plugin']->contribute('overview_buttons','Search article', 'search','view.png','0','slave1');

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

    if(XT::getSessionValue('ctrl_add')){
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
    rel.article_id as id,
    a.display_time_start,
    a.display_time_end
    FROM
        " . XT::getTable('articles_tree_rel') . " as rel INNER JOIN 
        " . XT::getTable('articles_v') . " as a ON (a.id = rel.article_id AND a.latest = 1 AND a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
    WHERE
        rel.node_id IN (" . implode(',',$nodes) . ")
    ORDER BY
        a.title ASC
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    if(($row['display_time_start'] < TIME && $row['display_time_end'] > TIME) || ($row['display_time_start'] < TIME && $row['display_time_end'] == 0) || ($row['display_time_start'] ==0  && $row['display_time_end'] > TIME) ){
        $row['timer'] = 'running';
    }else {
        $row['timer'] = 'ready';
    }
    if ($row['display_time_end'] < TIME && $row['display_time_end'] != 0)   {
        $row['timer'] = 'expired';
    }
    if ($row['display_time_start'] == 0 && $row['display_time_end'] == 0)   {
        $row['timer'] = 'unused';
    } 
    $data[$row['node_id']][] = $row;
}


// SQL
$result = XT::query("SELECT
    a.title,
    a.subtitle,
    a.creation_date,
    a.active,
    a.locked,
    a.locked_user,
    a.locked_date,
    a.published,
    a.rid,
    concat(1) as node_id,
    a.id as id,
    a.display_time_start,
    a.display_time_end
FROM " . XT::getTable('articles_v') . " as a 
LEFT JOIN " . XT::getTable('articles_tree_rel') . " as rel ON (a.id = rel.article_id) 
WHERE rel.node_id is NULL AND a.latest = 1 AND a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
ORDER BY a.title ASC
    ",__FILE__,__LINE__);


while($row = $result->FetchRow()){
    if(($row['display_time_start'] < TIME && $row['display_time_end'] > TIME) || ($row['display_time_start'] < TIME && $row['display_time_end'] == 0) || ($row['display_time_start'] ==0  && $row['display_time_end'] > TIME) ){
        $row['timer'] = 'running';
    }else {
        $row['timer'] = 'ready';
    }
    if ($row['display_time_end'] < TIME && $row['display_time_end'] != 0)   {
        $row['timer'] = 'expired';
    }
    if ($row['display_time_start'] == 0 && $row['display_time_end'] == 0)   {
        $row['timer'] = 'unused';
    } 
    $data[$row['node_id']][] = $row;
}




XT::assign("ARTICLES", $data);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build("overview.tpl");
?>