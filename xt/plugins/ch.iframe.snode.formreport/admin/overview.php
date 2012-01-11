<?php

require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title');
$count = $treewidget->buildTree('formreport_tree','formreport_tree_details','%s','',$in);
$data = $treewidget->getData();

if(XT::getPermission('add')){

    // Add Buttons
   /* if(XT::getPermission('add')){
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
*/


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

$nodes2 = array();
foreach($data as $key => $node){
    $nodes2[] = $node['id'];
}

// SQL
$result = XT::query("
    SELECT
    p.title,
    p.time_start,
	p.time_end,
    rel.node_id,
    rel.report_id as id
    FROM
        " . XT::getTable('formreport_tree_rel') . " as rel
    INNER JOIN
        " . XT::getTable('formreport') . " as p ON (p.id = rel.report_id )
    WHERE
        rel.node_id IN (" . implode(',',$nodes2) . ")
    ORDER BY
        p.title ASC
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
    p.title,
    p.time_start,
	p.time_end,
    concat(1) as node_id,
    p.id as id
FROM
	" . XT::getTable('formreport') . " as p
LEFT JOIN
	 " . XT::getTable('formreport_tree_rel') . " as rel ON (p.id = rel.report_id)
WHERE
	 rel.node_id is NULL
ORDER BY
	 p.title ASC
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






XT::assign("REPORTS", $data);


$content = XT::build("overview.tpl");
?>