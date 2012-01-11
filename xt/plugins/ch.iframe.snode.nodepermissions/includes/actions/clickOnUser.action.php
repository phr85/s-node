<?php
$GLOBALS['preplugin_content'] .= "<script language=\"javascript\"><!--
window.parent.frames['slave1'].document.forms[0].x" . $GLOBALS['plugin']->getBaseId() . "_module.value='s1User';
window.parent.frames['slave1'].document.forms[0].x" . $GLOBALS['plugin']->getBaseId() . "_user_id.value=" . $GLOBALS['plugin']->getValue('user_id') . ";
window.parent.frames['slave1'].document.forms[0].submit();
//-->
</script>";
?>