<?php
echo "<script language=\"javascript\"><!--
window.parent.frames['slave1'].document.forms[0].x" . $GLOBALS['plugin']->getBaseId() . "_node_id.value=" . $GLOBALS['plugin']->getValue('active') . ";
window.parent.frames['slave1'].document.forms[0].x" . $GLOBALS['plugin']->getBaseId() . "_action.value='showBrowserArticles';
window.parent.frames['slave1'].document.forms[0].submit();
//-->
</script>";

?>
