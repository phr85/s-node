<?php
$result = XT::query("SELECT (max(position) +1) as position FROM " . XT::getTable('relations') . " WHERE target_content_type=" . XT::getValue('ctype')  . " AND target_content_id=" . XT::getValue('cid'),__FILE__,__LINE__);
$position = XT::getQueryData($result);
if($position[0]['position']==""){
    $position[0]['position']=1;
}

$result = XT::query("SELECT tree.id from " . XT::getTable(XT::getParam('table_tree')) . " as tree, " . XT::getTable(XT::getParam('table_tree')) . " as tree2 WHERE tree2.id =" . XT::getValue('node_id') . " AND tree.l >= tree2.l AND tree.r <= tree2.r ",__FILE__,__LINE__);
while($row = $result->FetchRow()){
    XT::query("insert into " . XT::getTable('relations') . " ( `id`, `lang`, `content_id`, `content_type`, `target_content_type`, `target_content_id`, `priority`, `title`, `description`, `image`, `type`, `position` ) values (  NULL,  '" . XT::getLang() . "',  '" . $row['id'] . "',  '" . XT::getValue('univctype') . "',  " . XT::getValue('ctype') . ",  " . XT::getValue('cid') . ",  '0',  '" . $_REQUEST['ctitle'] . "',  NULL,  '0',  '0',  '" . $position[0]['position'] . "' )",__FILE__,__LINE__);
    $position[0]['position']++;
}
?>