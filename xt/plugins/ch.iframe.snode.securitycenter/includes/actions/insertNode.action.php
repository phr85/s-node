<?php

include_once(CLASS_DIR . 'tree.class.php');
$tree = new XT_Tree("pools");
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

if($GLOBALS['plugin']->getSessionValue("ctrl_cut")){
    $GLOBALS['plugin']->setSessionValue('open',$GLOBALS['plugin']->getSessionValue("source_node_id"));
    $GLOBALS['plugin']->setValue("node_id",$GLOBALS['plugin']->getSessionValue("source_node_id"));
    $GLOBALS['plugin']->setAdminModule("editPool");

    $GLOBALS['preplugin_content'] .= "<script language=\"javascript\"><!--
yoffset = window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].x" . $GLOBALS['plugin']->getBaseId() . "_yoffset.value=yoffset
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>";
}


if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
    $GLOBALS['plugin']->setSessionValue('open',$newid);
    $GLOBALS['plugin']->setAdminModule("editPool");
    
    $GLOBALS['preplugin_content'] .= "<script language=\"javascript\"><!--
yoffset = window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].x" . $GLOBALS['plugin']->getBaseId() . "_yoffset.value=yoffset
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>";
    
    $GLOBALS['plugin']->setValue("node_id", $newid);

    // Create detail row
    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('pools_details') . "
        (
            node_id,
            title
        ) VALUES (
            " . $GLOBALS['plugin']->getValue('node_id') . ",
            'new'
        )
    ");
}


$GLOBALS['plugin']->unsetSessionValue("ctrl_add");
$GLOBALS['plugin']->unsetSessionValue("ctrl_cut");
$GLOBALS['plugin']->unsetSessionValue("ctrl_copy");

?>
