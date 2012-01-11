<?php
$data = XT::getQueryData(XT::query("SELECT position FROM " . $GLOBALS['plugin']->getSessionValue('assign_table') . " where " . $GLOBALS['plugin']->getSessionValue('assign_field') . "=" . $GLOBALS['plugin']->getSessionValue('assign_id') . " AND article_id = " . $GLOBALS['plugin']->getValue('article_id'),__FILE__,__LINE__,0));
XT::query("DELETE FROM " . $GLOBALS['plugin']->getSessionValue('assign_table') . " where " . $GLOBALS['plugin']->getSessionValue('assign_field') . "=" . $GLOBALS['plugin']->getSessionValue('assign_id') . " AND article_id = " . $GLOBALS['plugin']->getValue('article_id'),__FILE__,__LINE__,0);
XT::query("UPDATE " . $GLOBALS['plugin']->getSessionValue('assign_table') . " SET position = position-1 where " . $GLOBALS['plugin']->getSessionValue('assign_field') . "=" . $GLOBALS['plugin']->getSessionValue('assign_id') . " AND position > " . ($data[0]['position']) ,__FILE__,__LINE__,0);

$GLOBALS['preplugin_content'] .= '<script language="javascript"><!--

yoffset = window.opener.pageYOffset;
window.opener.document.forms[0].submit();
setTimeout("window.opener.scrollTo(0,yoffset)",1000);

//-->
</script>';

?>
