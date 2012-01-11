<?PHP
XT::query("DELETE 
   FROM 
       " . XT::getTable('pools_rel') . " 
   WHERE 
       node_id= " . $GLOBALS['plugin']->getSessionValue('open') . " 
   AND 
       principal_id= " . $GLOBALS['plugin']->getValue('principal_id') . "
   AND 
       principal_type=1",__FILE__,__LINE__);

$GLOBALS['plugin']->setAdminModule('users');

$GLOBALS['preplugin_content'] .= "<script language=\"javascript\"><!--
yoffset = window.parent.frames['slave2'].pageYOffset;
window.parent.frames['slave2'].document.forms[0].x" . $GLOBALS['plugin']->getBaseId() . "_yoffset.value=yoffset
window.parent.frames['slave2'].document.forms[0].submit();
//-->
</script>";
?>