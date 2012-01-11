<?php
if(is_numeric($GLOBALS['plugin']->getValue("node_id"))){
    include_once(CLASS_DIR . 'tree.class.php');
    $tree = new XT_Tree("pools");
    $deleted_nodes = $tree->nodeDelete($GLOBALS['plugin']->getValue("node_id"));
    foreach ($deleted_nodes as $row) {
        $in .= ", " . $row['id'];
    }

    // Delete node details
    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("pools_details") . " WHERE
        node_id in (" . $GLOBALS['plugin']->getValue("node_id") . $in . ")",__FILE__,__LINE__);


    // Delete Principals
    XT::query("DELETE
   FROM 
       " . XT::getTable('pools_rel') . " 
   WHERE 
       node_id in (" . $GLOBALS['plugin']->getValue("node_id") . $in . ")",__FILE__,__LINE__);
    $GLOBALS['plugin']->setAdminModule('o');

}

?>
