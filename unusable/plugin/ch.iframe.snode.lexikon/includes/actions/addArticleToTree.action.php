<?php
$data = XT::getQueryData(XT::query("SELECT max(position) as position FROM " . $GLOBALS['plugin']->getSessionValue('assign_table') . " where " . $GLOBALS['plugin']->getSessionValue('assign_field') . "=" . $GLOBALS['plugin']->getSessionValue('assign_id'),__FILE__,__LINE__,0));
$count = XT::getQueryData(XT::query("SELECT count(article_id) as count FROM " . $GLOBALS['plugin']->getSessionValue('assign_table') . " where " . $GLOBALS['plugin']->getSessionValue('assign_field') . "=" . $GLOBALS['plugin']->getSessionValue('assign_id') . " AND article_id=" . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__,0));
if($count[0]['count'] < 1){
    XT::query("INSERT INTO
                   " . $GLOBALS['plugin']->getSessionValue('assign_table') . "
                   (" . $GLOBALS['plugin']->getSessionValue('assign_field') . ", article_id, position)
               VALUES
                   (" . $GLOBALS['plugin']->getSessionValue('assign_id') . "," . $GLOBALS['plugin']->getValue('id') . "," . ($data[0]['position']+1) . ")",__FILE__,__LINE__);
}

echo '<script language="javascript"><!--
yoffset = window.opener.pageYOffset;
window.opener.document.forms[0].submit();
setTimeout("window.opener.scrollTo(0,yoffset)",1000);
//-->
</script>';

?>
