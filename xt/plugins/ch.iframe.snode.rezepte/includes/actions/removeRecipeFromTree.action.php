<?php
$data = XT::getQueryData(XT::query("SELECT position FROM " . XT::getSessionValue('assign_table') . " where " . XT::getSessionValue('assign_field') . "=" . XT::getSessionValue('assign_id') . " AND recipe_id = " . XT::getValue('recipe_id'),__FILE__,__LINE__,0));
XT::query("DELETE FROM " . XT::getSessionValue('assign_table') . " where " . XT::getSessionValue('assign_field') . "=" . XT::getSessionValue('assign_id') . " AND recipe_id = " . XT::getValue('recipe_id'),__FILE__,__LINE__,0);
XT::query("UPDATE " . XT::getSessionValue('assign_table') . " SET position = position-1 where " . XT::getSessionValue('assign_field') . "=" . XT::getSessionValue('assign_id') . " AND position > " . ($data[0]['position']) ,__FILE__,__LINE__,0);

$GLOBALS['preplugin_content'] .= '<script language="javascript"><!--

yoffset = window.opener.pageYOffset;
window.opener.document.forms[0].submit();
setTimeout("window.opener.scrollTo(0,yoffset)",1000);

//-->
</script>';

?>
