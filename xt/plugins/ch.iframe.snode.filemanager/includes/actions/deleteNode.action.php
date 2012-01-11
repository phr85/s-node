<?php
if(is_numeric($GLOBALS['plugin']->getValue("node_id"))){
    include_once(CLASS_DIR . 'tree.class.php');
    $tree = new XT_Tree("files_tree");
    $nodes = $tree->nodeDelete($GLOBALS['plugin']->getValue("node_id"),1);
    foreach ($nodes as $node) {
        // delete files in the node
        $result = XT::query("SELECT file_id FROM " . $GLOBALS['plugin']->getTable("files_rel") . " WHERE node_id = " . $node['id'],__FILE__,__LINE__);
        XT::loadClass('searchindex.class.php','ch.iframe.snode.search');
        while($row = $result->FetchRow()){
            XT::setValue("file_id",$row["file_id"]);
            XT::call('deleteFile');
        }

        // Delete node permissions
        XT::query("DELETE FROM " . $GLOBALS['cfg']->get("database","prefix") . "node_perms WHERE
        base_id = " . $GLOBALS['plugin']->getBaseID() . " AND
        node_id = " . $node['id'],__FILE__,__LINE__);

        // Delete node details
        XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("files_tree_details") . " WHERE
        node_id = " . $node['id'],__FILE__,__LINE__);

    }
}
?>