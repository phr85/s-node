<?php
$GLOBALS['preplugin_content'] .= "<script language=\"javascript\"><!--
window.parent.frames['slave1'].document.forms[0].x" . $GLOBALS['plugin']->getBaseId() . "_module.value='s1Group';
window.parent.frames['slave1'].document.forms[0].x" . $GLOBALS['plugin']->getBaseId() . "_group_id.value=" . $GLOBALS['plugin']->getValue('group_id') . ";
window.parent.frames['slave1'].document.forms[0].submit();
//-->
</script>";
?>