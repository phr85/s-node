<?php
if(is_numeric(XT::getValue("node_id"))){
    include_once(CLASS_DIR . 'tree.class.php');
    $tree = new XT_Tree("faq_tree");
    if($tree->nodeDelete(XT::getValue("node_id"))){
        XT::log("Folder deleted successfully",__FILE__,__LINE__,XT_INFO);
    }

    // Delete node permissions
    XT::query("DELETE FROM " . $GLOBALS['cfg']->get("database","prefix") . "node_perms WHERE
        base_id = " . XT::getBaseID() . " AND
        node_id = " . XT::getValue('node_id'),__FILE__,__LINE__);

    // Delete node details
    XT::query("DELETE FROM " . XT::getTable("faq_tree_details") . " WHERE
        node_id = " . XT::getValue('node_id'),__FILE__,__LINE__);
   
    // Delete node relations
    
	XT::query("DELETE FROM " . XT::getTable("faq2cat") . " WHERE node_id = " . XT::getValue("node_id") . "",__FILE__,__LINE__);
    
}
XT::setValue('active',XT::getValue('node_pid'));
XT::setAdminModule('categories');

?>