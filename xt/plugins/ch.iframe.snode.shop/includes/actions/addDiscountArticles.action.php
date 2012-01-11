<?php
$GLOBALS['plugin']->call('saveDiscounts');
// set session values for the picker
$GLOBALS['plugin']->setSessionValue('assign_table', $GLOBALS['plugin']->getTable('discounts_articles'), $GLOBALS['plugin']->getConfig('article_picker_base_id'));
$GLOBALS['plugin']->setSessionValue('assign_field', 'discount_id', $GLOBALS['plugin']->getConfig('article_picker_base_id'));
$GLOBALS['plugin']->setSessionValue('assign_id', $GLOBALS['plugin']->getValue('id'), $GLOBALS['plugin']->getConfig('article_picker_base_id'));

$GLOBALS['preplugin_content'] .= '<script language="javascript"><!--
popup(\'' . $_SERVER['PHP_SELF'] . '?TPL=' . $GLOBALS['plugin']->getConfig('article_picker_tpl') . '\',650,500);

//-->
</script>';
$GLOBALS['plugin']->setAdminModule('de');
?>
