<?php

include_once(CLASS_DIR . 'tree.class.php');
$tree = new XT_Tree("tree");

switch($GLOBALS['plugin']->getValue("position")){
    case 'into':
    if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
        $newid = $tree->addChildNode($GLOBALS['plugin']->getValue("node_id"));
    }
    if($GLOBALS['plugin']->getSessionValue("ctrl_cut")){
        $newid = $tree->moveNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'last');
    }
    break;
    case 'before':
    if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
        $newid = $tree->addNode($GLOBALS['plugin']->getValue("node_id"),"before");
    }
    if($GLOBALS['plugin']->getSessionValue("ctrl_cut")){
        $newid = $tree->moveNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'before');
    }
    break;

    case 'after':
    if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
        $newid = $tree->addNode($GLOBALS['plugin']->getValue("node_id"),"after");
    }
    if($GLOBALS['plugin']->getSessionValue("ctrl_cut")){
        $newid = $tree->moveNode($GLOBALS['plugin']->getSessionValue("source_node_id"),$GLOBALS['plugin']->getValue("node_id"),'after');
    }
    break;
}
if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
    foreach($GLOBALS['cfg']->getLangs() as $key => $value){
        XT::query("
    INSERT INTO
        " . $GLOBALS['cfg']->get("database","prefix") . "node_perms
    (
        base_id,
        node_id,
        principal_id,
        principal_type,
        perms,
        lang
    ) VALUES (
        " . $GLOBALS['plugin']->getBaseID() . ",
        " . $newid . ",
        " . XT::getUserID() . ",
        1,
        1048575,
        '" . $key . "'
    )",__FILE__,__LINE__);


        XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable("nodes") . "
    (
        node_id,
        title,
        description,
        lang
    ) VALUES (
        " . $newid . ",
        NULL,
        NULL,
        '" . $key . "'
    )
    ",__FILE__,__LINE__);
    }


    $GLOBALS['plugin']->setValue("node_id", $newid);
    $GLOBALS['plugin']->setAdminModule("en");




}



$GLOBALS['plugin']->unsetSessionValue("ctrl_add");
$GLOBALS['plugin']->unsetSessionValue("ctrl_cut");
?>
