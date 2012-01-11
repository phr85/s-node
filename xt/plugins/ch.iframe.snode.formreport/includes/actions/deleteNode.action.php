<?php
if(is_numeric($GLOBALS['plugin']->getValue("node_id"))){
    include_once(CLASS_DIR . 'tree.class.php');
    $tree = new XT_Tree("formreport_tree");
    $deleted_nodes = $tree->nodeDelete($GLOBALS['plugin']->getValue("node_id"));

    // Get ID's of deleted nodes
    $nodes = array();
    foreach($deleted_nodes as $values){
        $nodes[] = $values['id'];
    }
    
    // Delete node permissions
/*    XT::query("DELETE FROM " . $GLOBALS['cfg']->get("database","prefix") . "node_perms WHERE
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND 
        base_id = " . $GLOBALS['plugin']->getBaseID() . " AND
        node_id IN (" . implode(',',$nodes) . ")",__FILE__,__LINE__);

*/
    // Delete node details
    XT::query("DELETE FROM " . XT::getTable("formreport_tree_details") . " WHERE
        lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND 
        node_id IN (" . implode(',',$nodes) . ")",__FILE__,__LINE__);
    
    // Get all poll
    $result = XT::query("
        SELECT 
            report_id 
        FROM 
            " . XT::getTable("formreport_tree_rel") . " 
        WHERE
            node_id IN (" . implode(',',$nodes) . ")
    ",__FILE__,__LINE__);
    
    $tmp_data = array();
    $to_delete = array();
    while($row = $result->FetchRow()){
        $to_delete[$row['report_id']] = true;
        if(in_array($row['report_id'],$tmp_data)){
            unset($to_delete[$row['report_id']]);
        } else {
            $tmp_data[] = $row['report_id'];
        }
    }
    
    // Delete node details relations
    XT::query("DELETE FROM " . XT::getTable("formreport_tree_rel") . " WHERE
        node_id IN (" . implode(',',$nodes) . ")
    ",__FILE__,__LINE__);
    
    $to_delete = array_keys($to_delete);


}
?>