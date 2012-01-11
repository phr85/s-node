<?php
if(is_numeric(XT::getValue("node_id"))){
    include_once(CLASS_DIR . 'tree.class.php');
    $tree = new XT_Tree("galleries");
    $deleted_nodes = $tree->nodeDelete(XT::getValue("node_id"));

    
    
    // Delete relations
    foreach($deleted_nodes as $key => $value){        
        XT::query("DELETE FROM " . XT::getTable('galleries_rel') . " WHERE gallery_id = " . $value['id'],__FILE__,__LINE__);
        XT::query("DELETE FROM " . XT::getTable('galleries_folder_rel') . " WHERE gallery_id = " . $value['id'],__FILE__,__LINE__);
        
        // Delete node permissions
        XT::query("DELETE FROM " . $GLOBALS['cfg']->get("database","prefix") . "node_perms WHERE
        	base_id = " . XT::getBaseID() . " AND
        	node_id = " . $value['id'],__FILE__,__LINE__);

		// Delete node details
    	XT::query("DELETE FROM " . XT::getTable("galleries_details") . " WHERE
        	node_id = " . $value['id'],__FILE__,__LINE__);
    	}
    	
    	XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
		$search = new XT_SearchIndex($value['id'],$GLOBALS['plugin']->getContentType("Gallery"),1);
		$search->delete();
}
?>