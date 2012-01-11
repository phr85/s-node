<?php
$GLOBALS['preplugin_content'] .= "<script language=\"javascript\"><!--
window.parent.frames['slave1'].document.forms[0].x" . $GLOBALS['plugin']->getBaseId() . "_module.value='s1Role';
window.parent.frames['slave1'].document.forms[0].x" . $GLOBALS['plugin']->getBaseId() . "_role_id.value=" . $GLOBALS['plugin']->getValue('role_id') . ";
window.parent.frames['slave1'].document.forms[0].submit();
//-->
</script>";
?>