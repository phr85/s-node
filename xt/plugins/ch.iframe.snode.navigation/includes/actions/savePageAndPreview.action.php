<?php
$GLOBALS['plugin']->call("savePage");

$GLOBALS['preplugin_content'] .= '<script type="text/javascript"><!--
window.open(\'' . $_SERVER['PHP_SELF'] . '?TPL=' . $GLOBALS['plugin']->getValue("node_id") . '\');
//-->
</script>';
?>