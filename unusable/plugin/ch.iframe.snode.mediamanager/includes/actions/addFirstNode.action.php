<?php

$GLOBALS['plugin']->unsetSessionValue("ctrl_add");


include_once(CLASS_DIR . 'tree.class.php');
$tree = new XT_Tree("tree");
$newid = $tree->addChildNode(1);

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
}

$GLOBALS['plugin']->setValue("node_id", $newid);
$GLOBALS['plugin']->setAdminModule("ef");

?>
