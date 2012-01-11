<?php

$title = $GLOBALS['plugin']->getValue("title");

if($title != ''){

   
        XT::query("
            UPDATE " . $GLOBALS['plugin']->getTable("pools_details") . "
            SET title= '" . $title . "' WHERE node_id=" . $GLOBALS['plugin']->getValue("node_id")
            ,__FILE__,__LINE__);
    
} else {
    XT::log("Node name cannot be empty",__FILE__,__LINE__,XT_ERROR);
}
$GLOBALS['plugin']->setAdminModule('editPool');

$GLOBALS['preplugin_content'] .= "<script language=\"javascript\"><!--
yoffset = window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].x" . $GLOBALS['plugin']->getBaseId() . "_yoffset.value=yoffset
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>";
?>
