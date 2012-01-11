<?php
if(is_numeric($GLOBALS['plugin']->getValue("node_id"))){
    include_once(CLASS_DIR . 'tree.class.php');
    $tree = new XT_Tree("events_tree");
    $deleted_nodes = $tree->nodeDelete($GLOBALS['plugin']->getValue("node_id"));
    $result = XT::query("DELETE FROM " . XT::getTable("events_tree_details") . " WHERE node_id=" .$GLOBALS['plugin']->getValue("node_id"));
    
    // Get ID's of deleted nodes
    $nodes = array();
    foreach($deleted_nodes as $values){
        $nodes[] = $values['id'];
    }
    
    // Get all events
    $result = XT::query("
        SELECT 
            event_id 
        FROM 
            " . XT::getTable("events_tree_rel") . " 
        WHERE
            node_id IN (" . implode(',',$nodes) . ")
    ",__FILE__,__LINE__);
    
    $tmp_data = array();
    $to_delete = array();
    while($row = $result->FetchRow()){
        $to_delete[$row['event_id']] = true;
        if(in_array($row['event_id'],$tmp_data)){
            unset($to_delete[$row['event_id']]);
        } else {
            $tmp_data[] = $row['event_id'];
        }
    }
    
    // Delete node details relations
    XT::query("DELETE FROM " . XT::getTable("events_tree_rel") . " WHERE
        node_id IN (" . implode(',',$nodes) . ")
    ",__FILE__,__LINE__);
    
    $to_delete = array_keys($to_delete);
    
    // Delete events
    if(sizeof($to_delete) > 0){
        // Delete events
        XT::query("DELETE FROM " . XT::getTable("events") . " WHERE id IN (" . implode(',',$to_delete) . ")",__FILE__,__LINE__);
        XT::query("DELETE FROM " . XT::getTable("events_details") . " WHERE id IN (" . implode(',',$to_delete) . ")",__FILE__,__LINE__);
    }
}
?>