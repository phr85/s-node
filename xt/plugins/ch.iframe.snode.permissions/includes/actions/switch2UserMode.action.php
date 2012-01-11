<?PHP
$GLOBALS['plugin']->setAdminModule('mUser');
$GLOBALS['preplugin_content'] .= "<script language=\"javascript\"><!--
window.parent.frames['slave1'].document.forms[0].x" . $GLOBALS['plugin']->getBaseId() . "_module.value='slave1';
window.parent.frames['slave1'].document.forms[0].submit();
//-->
</script>";
?>