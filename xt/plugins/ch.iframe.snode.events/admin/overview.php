<?php
function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title','active','public');
$count = $treewidget->buildTree('events_tree','events_tree_details','%s','',$in);
$data = $treewidget->getData();

$nodes = array();
foreach($data as $key => $node){
    $nodes[] = $node['id'];
}

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
    $GLOBALS['plugin']->contribute('overview_buttons','Add event', 'addEventRel','document_new.png','0','slave1');

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

// SQL
$result = XT::query("
    SELECT
        events.id,
        events.from_date,
        events_details.title,
        events_details.active,
        events_details.introduction,
        events_tree_rel.node_id,
        regs.address_id as registrations,
        events.display_time_start,
        events.display_time_end
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
        events.from_date DESC
    ",__FILE__,__LINE__,0);

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
XT::assign("EVENTS", $data);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build("overview.tpl");
?>