<?php

include_once(PLUGIN_DIR . "ch.iframe.snode.filemanager/includes/config.special.ext.inc.php");
include_once(CLASS_DIR . 'tree.class.php');
$tree = new XT_Tree("files_tree");
$home_node_id = $tree->addTree();

// Create detail row
XT::query("INSERT INTO " . XT::getTable('files_tree_details') . "
    (
        node_id,
        title,
        lang,
        creation_user,
        creation_date
    ) VALUES (
        " . $home_node_id . ",
        '" . XT::getValue("username") . "',
        '" . XT::getLang() . "',
        '" . 0 . "',
        '" . time() . "'
    )
",__FILE__,__LINE__);

XT::setValue("home_node_id",$home_node_id);
XT::log("Folder \"" . XT::getValue("username") . "\" created successfully",__FILE__,__LINE__,XT_INFO);

?>