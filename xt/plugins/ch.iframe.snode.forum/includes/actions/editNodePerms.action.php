<?php
 
$GLOBALS['preplugin_content'] .= '<script language="JavaScript">
    popup(\'' .$_SERVER['PHP_SELF']
 . '?TPL=' .$GLOBALS['plugin']->getConfig('node_manager_tpl')
 . '&x' .$GLOBALS['plugin']->getConfig('node_manager_base_id') . '_node_id=' .$GLOBALS['plugin']->getValue("node_id")
 . '&x' .$GLOBALS['plugin']->getConfig('node_manager_base_id') . '_base_id=' .$GLOBALS['plugin']->getBaseID()
 . '&x' .$GLOBALS['plugin']->getConfig('node_manager_base_id') . '_lang_filter=' .$GLOBALS['plugin']->getActiveLang()
 . '&x' .$GLOBALS['plugin']->getConfig('node_manager_base_id') . '_package=' .$GLOBALS['plugin']->package
 . '&adminmode=1\',550,450);
</script>';
?>
