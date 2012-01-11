<?php
$GLOBALS['preplugin_content'] .= "<script language=\"javascript\"><!--
window.parent.frames['slave1'].document.forms[0].x" . $GLOBALS['plugin']->getBaseId() . "_module.value='dp'
window.parent.frames['slave1'].document.forms[0].x" . $GLOBALS['plugin']->getBaseId() . "_principal_id.value=" . $GLOBALS['plugin']->getValue('principal_id') . "
window.parent.frames['slave1'].document.forms[0].submit();

window.parent.frames['slave2'].document.forms[0].x" . $GLOBALS['plugin']->getBaseId() . "_module.value='s2Pool'
window.parent.frames['slave2'].document.forms[0].x" . $GLOBALS['plugin']->getBaseId() . "_principal_id.value=" . $GLOBALS['plugin']->getValue('principal_id') . "
window.parent.frames['slave2'].document.forms[0].submit();
//-->
</script>";
?>