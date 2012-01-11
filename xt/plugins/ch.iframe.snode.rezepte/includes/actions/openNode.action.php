<?php
$GLOBALS['preplugin_content'] .= "<script language=\"javascript\"><!--
window.parent.frames['slave1'].document.forms[0].x" . $GLOBALS['plugin']->getBaseId() . "_node_id.value=" . XT::getValue('active') . ";
window.parent.frames['slave1'].document.forms[0].x" . $GLOBALS['plugin']->getBaseId() . "_action.value='showBrowserRecipes';
window.parent.frames['slave1'].document.forms[0].submit();
//-->
</script>";
?>
