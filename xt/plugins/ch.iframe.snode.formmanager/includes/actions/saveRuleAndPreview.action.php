<?php
$GLOBALS['plugin']->call("saveRule");

$GLOBALS['preplugin_content'] .= '<script type="text/javascript"><!--
window.open(\'' . $_SERVER['PHP_SELF'] .'?TPL=' . $GLOBALS['plugin']->getConfig("viewer_tpl") . '&x' . $GLOBALS['plugin']->getBaseID() .'_form_id=' . $GLOBALS['plugin']->getSessionValue("form_id") .'\');
//-->
</script>';
?>