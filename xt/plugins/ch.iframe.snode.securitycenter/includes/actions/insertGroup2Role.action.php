<?PHP
XT::query("DELETE
   FROM 
       " . XT::getTable('group_roles') . " 
   WHERE 
       role_id= " . $GLOBALS['plugin']->getSessionValue('role_id') . " 
   AND 
       group_id= " . $GLOBALS['plugin']->getValue('group_id')
,__FILE__,__LINE__);

XT::query("INSERT
    INTO
       " . XT::getTable('group_roles') . " 
       (group_id, role_id)
    VALUES 
       (" . $GLOBALS['plugin']->getValue('group_id') . ", " . $GLOBALS['plugin']->getSessionValue('role_id') . " )
",__FILE__,__LINE__);


$GLOBALS['preplugin_content'] .= "<script language=\"javascript\"><!--
yoffset = window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].x" . $GLOBALS['plugin']->getBaseId() . "_yoffset.value=yoffset
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>";
?>