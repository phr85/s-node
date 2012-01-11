<?php
// set session values for the picker
$GLOBALS['plugin']->setSessionValue('assign_table', XT::getTable('r2tree'), $GLOBALS['plugin']->getConfig('recipe_picker_base_id'));
$GLOBALS['plugin']->setSessionValue('assign_field', 'node_id', $GLOBALS['plugin']->getConfig('recipe_picker_base_id'));
$GLOBALS['plugin']->setSessionValue('assign_id', XT::getSessionValue('open'), $GLOBALS['plugin']->getConfig('recipe_picker_base_id'));

$GLOBALS['preplugin_content'] .= '<script language="javascript"><!--
popup(\'' . $_SERVER['PHP_SELF'] . '?TPL=' . $GLOBALS['plugin']->getConfig('recipe_picker_tpl') . '\',650,720);

//-->
</script>';

?>
