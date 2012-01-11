<?php
$count = XT::getQueryData(XT::query("SELECT count(recipe_id) as count FROM " . XT::getSessionValue('assign_table') . " where " . XT::getSessionValue('assign_field') . "=" . XT::getSessionValue('assign_id') . " AND recipe_id=" . XT::getValue('id'),__FILE__,__LINE__,0));
if($count[0]['count'] < 1){
    XT::query("
        UPDATE
            " . XT::getSessionValue('assign_table') . "
        SET
            position = position + 1
        WHERE
            " . XT::getSessionValue('assign_field') . "=" . XT::getSessionValue('assign_id')
    ,__FILE__,__LINE__,0);

    XT::query("INSERT INTO
                   " . XT::getSessionValue('assign_table') . "
                   (" . XT::getSessionValue('assign_field') . ", recipe_id, position)
               VALUES
                   (" . XT::getSessionValue('assign_id') . "," . XT::getValue('id') . ", 1 )",__FILE__,__LINE__);

}

$GLOBALS['preplugin_content'] .= '<script language="javascript"><!--
yoffset = window.opener.pageYOffset;
window.opener.document.forms[0].submit();
setTimeout("window.opener.scrollTo(0,yoffset)",1000);
//-->
</script>';

?>
