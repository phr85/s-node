<?php
$selection = XT::getSessionValue('selection');
$GLOBALS['preplugin_content'] .= "<script language=\"javascript\"><!--
window.parent.opener.document.forms['" . $GLOBALS['plugin']->getSessionValue("form") . "']." . $GLOBALS['plugin']->getSessionValue("field") . "_title.value='" . substr($selection,0,-1) . "';
window.parent.opener.document.forms['" . $GLOBALS['plugin']->getSessionValue("form") . "']." . $GLOBALS['plugin']->getSessionValue("field") . ".value='" . substr($selection,0,-1) . "';
window.parent.close();
//-->
</script>";
?>