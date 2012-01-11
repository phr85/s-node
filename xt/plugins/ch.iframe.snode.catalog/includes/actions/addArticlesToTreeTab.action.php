<?php
// set session values for the picker
$GLOBALS['plugin']->setSessionValue('assign_table', $GLOBALS['plugin']->getTable('tree2articles'), $GLOBALS['plugin']->getConfig('article_picker_base_id'));
$GLOBALS['plugin']->setSessionValue('assign_field', 'node_id', $GLOBALS['plugin']->getConfig('article_picker_base_id'));
$GLOBALS['plugin']->setSessionValue('assign_id', $GLOBALS['plugin']->getSessionValue('open'), $GLOBALS['plugin']->getConfig('article_picker_base_id'));

$GLOBALS['preplugin_content'] .= '<script language="javascript"><!--
popup(\'' . $_SERVER['PHP_SELF'] . '?TPL=' . $GLOBALS['plugin']->getConfig('article_picker_tpl') . '\',650,720);

//-->
</script>';

?>
