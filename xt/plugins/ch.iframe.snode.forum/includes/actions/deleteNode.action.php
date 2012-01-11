<?php
if(is_numeric($GLOBALS['plugin']->getValue("node_id"))){
    include_once(CLASS_DIR . 'tree.class.php');
    $tree = new XT_Tree(XT::getTable("forum_categories"),false);
    if($tree->nodeDelete($GLOBALS['plugin']->getValue("node_id"))){
        XT::log("Folder deleted successfully",__FILE__,__LINE__,XT_INFO);
    }

    // Delete node permissions
    XT::query("DELETE FROM " . $GLOBALS['cfg']->get("database","prefix") . "node_perms WHERE
        base_id = " . $GLOBALS['plugin']->getBaseID() . " AND
        node_id = " . $GLOBALS['plugin']->getValue('node_id'),__FILE__,__LINE__);
    
    // Delete node details
    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("forum_categories_details") . " WHERE
        node_id = " . $GLOBALS['plugin']->getValue('node_id'),__FILE__,__LINE__);
    
    // TODO: delete forums ==> call("deleteforum");
}

$GLOBALS['plugin']->setValue('active',$GLOBALS['plugin']->getValue('node_pid'));

$GLOBALS['plugin']->setAdminModule('c');
?>