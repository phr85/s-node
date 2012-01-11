<?php
if(is_numeric($GLOBALS['plugin']->getValue("node_id"))){
    
    // Get parent id
    $result = XT::query("
        SELECT
            pid
        FROM 
            " . XT::getTable('navigation') . "
        WHERE id = '" . $GLOBALS['plugin']->getValue("node_id") . "'
    ");
    
    while($row = $result->fetchRow()){
        $pid = $row['pid'];
    }
    
    // Set open
    XT::setSessionValue('open', $pid);
    
    include_once(CLASS_DIR . 'tree.class.php');
    $tree = new XT_Tree("navigation");
    
    $deleted_nodes = $tree->nodeDelete($GLOBALS['plugin']->getValue("node_id"));
    if(is_array($deleted_nodes)){
        foreach($deleted_nodes as $node_id){
            // Index keywords and description
            XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
            $search = new XT_SearchIndex($node_id['id'],$GLOBALS['plugin']->getContentType("Page"),$GLOBALS['plugin']->getValue('public'));
            $search->delete();
        }
    } else {
        // Index keywords and description
        XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
        $search = new XT_SearchIndex($GLOBALS['plugin']->getValue('node_id'),$GLOBALS['plugin']->getContentType("Page"),$GLOBALS['plugin']->getValue('public'));
        $search->delete();
    }

    if(is_array($deleted_nodes)){
        foreach($deleted_nodes as $node_id){
            // Delete node permissions
            XT::query("DELETE FROM " . $GLOBALS['cfg']->get("database","prefix") . "node_perms WHERE
                base_id = " . $GLOBALS['plugin']->getBaseID() . " AND
                node_id = " . $node_id['id'],__FILE__,__LINE__);
            
            // Delete node details
            XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("navigation_details") . " WHERE
                node_id = " . $node_id['id'],__FILE__,__LINE__);
            
            @unlink(PAGES_DIR . '_pages/' . $node_id['id'] . '.tpl');
        }
    }
    
    // Delete relation if this page is a template
    XT::query("
        DELETE FROM " . XT::getTable('navigation_templates') . " WHERE tpl_id = " . XT::getValue('node_id') . "
    ",__FILE__,__LINE__);
    
}
?>