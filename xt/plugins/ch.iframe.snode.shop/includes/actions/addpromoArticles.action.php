<?php
$GLOBALS['plugin']->call('savepromo');
// set session values for the picker
$GLOBALS['plugin']->setSessionValue('assign_table', $GLOBALS['plugin']->getTable('promo_articles'), $GLOBALS['plugin']->getConfig('article_picker_base_id'));
$GLOBALS['plugin']->setSessionValue('assign_field', 'discount_id', $GLOBALS['plugin']->getConfig('article_picker_base_id'));
$GLOBALS['plugin']->setSessionValue('assign_id', $GLOBALS['plugin']->getValue('id'), $GLOBALS['plugin']->getConfig('article_picker_base_id'));

$GLOBALS['preplugin_content'] .= '<script language="javascript"><!--
popup(\'' . $_SERVER['PHP_SELF'] . '?TPL=' . $GLOBALS['plugin']->getConfig('article_picker_tpl') . '\',650,500);

//-->
</script>';
$GLOBALS['plugin']->setAdminModule('promoedit');
?>
