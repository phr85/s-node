<?php
$GLOBALS['plugin']->call('saveRecipe');
// set session values for the picker
$GLOBALS['plugin']->setSessionValue('assign_table', XT::getTable('recipe_relations'), $GLOBALS['plugin']->getConfig('recipe_picker_base_id'));
$GLOBALS['plugin']->setSessionValue('assign_field', 'main_recipe_id', $GLOBALS['plugin']->getConfig('recipe_picker_base_id'));
$GLOBALS['plugin']->setSessionValue('assign_id', XT::getSessionValue('recipeID'), $GLOBALS['plugin']->getConfig('recipe_picker_base_id'));
$GLOBALS['plugin']->setSessionValue('assign_title', XT::getValue('title'), $GLOBALS['plugin']->getConfig('recipe_picker_base_id'));


$GLOBALS['preplugin_content'] .= '<script language="javascript"><!--
popup(\'' . $_SERVER['PHP_SELF'] . '?TPL=' . $GLOBALS['plugin']->getConfig('recipe_picker_tpl') . '\',650,720);

//-->
</script>';
$GLOBALS['plugin']->setAdminModule('ea');
?>
