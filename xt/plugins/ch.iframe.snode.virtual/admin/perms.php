<?php $content ="<br />&nbsp;";

$GLOBALS['preplugin_content'] .= '<script language="JavaScript">
    popup(\'' .  $_SERVER['PHP_SELF']
     . '?TPL=' .  PERM_TPL
     . '&x' .  PERM_BASEID . '_base_id=' .  $GLOBALS['plugin']->getBaseId()
     . '&x' .  PERM_BASEID . '_lang_filter=' .  $GLOBALS['plugin']->getActiveLang()
     . '&x' .  PERM_BASEID . '_package=' .  $GLOBALS['plugin']->package . '&adminmode=1\',550,450);
</script>';

?>