<?php
$GLOBALS['plugin']->call('saveArticle');
// set session values for the picker
$GLOBALS['plugin']->setSessionValue('assign_table', $GLOBALS['plugin']->getTable('articles_relations'), $GLOBALS['plugin']->getConfig('article_picker_base_id'));
$GLOBALS['plugin']->setSessionValue('assign_field', 'main_article_id', $GLOBALS['plugin']->getConfig('article_picker_base_id'));
$GLOBALS['plugin']->setSessionValue('assign_id', $GLOBALS['plugin']->getSessionValue('articleID'), $GLOBALS['plugin']->getConfig('article_picker_base_id'));
$GLOBALS['plugin']->setSessionValue('assign_title', $GLOBALS['plugin']->getValue('title'), $GLOBALS['plugin']->getConfig('article_picker_base_id'));


echo '<script language="javascript"><!--
popup(\'' . $_SERVER['PHP_SELF'] . '?TPL=' . $GLOBALS['plugin']->getConfig('article_picker_tpl') . '\',650,500);

//-->
</script>';
$GLOBALS['plugin']->setAdminModule('ea');
?>
