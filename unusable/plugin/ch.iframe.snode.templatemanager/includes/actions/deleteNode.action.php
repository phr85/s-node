<?php
if(is_numeric($GLOBALS['plugin']->getValue("node_id"))){
    include_once(CLASS_DIR . 'tree.class.php');
    $tree = new XT_Tree("faq_tree");
    $tree->nodeDelete($GLOBALS['plugin']->getValue("node_id"));

    // Delete node permissions
    XT::query("DELETE FROM " . $GLOBALS['cfg']->get("database","prefix") . "node_perms WHERE
        base_id = " . $GLOBALS['plugin']->getBaseID() . " AND
        node_id = " . $GLOBALS['plugin']->getValue("node_id"),__FILE__,__LINE__);

    // Delete node details
    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("faq_tree_details") . " WHERE
        node_id = " . $GLOBALS['plugin']->getValue("node_id"),__FILE__,__LINE__);
}
?>