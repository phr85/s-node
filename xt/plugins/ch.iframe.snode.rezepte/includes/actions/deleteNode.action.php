<?php
if(is_numeric(XT::getValue("node_id"))){
    include_once(CLASS_DIR . 'tree.class.php');
    $tree = new XT_Tree("tree");
    if($tree->nodeDelete(XT::getValue("node_id"))){
        XT::log("Folder deleted successfully",__FILE__,__LINE__,XT_INFO);
    }

    // Delete node permissions
    XT::query("DELETE FROM " . $GLOBALS['cfg']->get("database","prefix") . "node_perms WHERE
        base_id = " . $GLOBALS['plugin']->getBaseID() . " AND
        node_id = " . XT::getValue('node_id'),__FILE__,__LINE__);

    // Delete node details
    XT::query("DELETE FROM " . XT::getTable("nodes") . " WHERE
        node_id = " . XT::getValue('node_id'),__FILE__,__LINE__);
}
$GLOBALS['plugin']->setValue('active',XT::getValue('node_pid'));
$GLOBALS['plugin']->setAdminModule('bt');
?>