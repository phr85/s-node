<?PHP
XT::query("DELETE 
   FROM 
       " . XT::getTable('pools_rel') . " 
   WHERE 
       node_id= " . $GLOBALS['plugin']->getSessionValue('open') . " 
   AND 
       principal_id= " . $GLOBALS['plugin']->getValue('principal_id') . "
   AND 
       principal_type=2",__FILE__,__LINE__);

XT::query("INSERT
   INTO 
       " . XT::getTable('pools_rel') . " 
       (node_id, principal_id, principal_type)
    VALUES 
        (" . $GLOBALS['plugin']->getSessionValue('open') . " , 
         " . $GLOBALS['plugin']->getValue('principal_id') . ", 
         2)
     ",__FILE__,__LINE__,0);
$GLOBALS['plugin']->setAdminModule('groups');

$GLOBALS['preplugin_content'] .= "<script language=\"javascript\"><!--
yoffset = window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].x" . $GLOBALS['plugin']->getBaseId() . "_yoffset.value=yoffset
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>";
?>