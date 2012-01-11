<?php

$result = XT::query("SELECT (max(position) +1) as position FROM " . XT::getTable('relations') . " WHERE target_content_type=" . XT::getValue('ctype')  . " AND target_content_id=" . XT::getValue('cid'),__FILE__,__LINE__);
$position = XT::getQueryData($result);
if($position[0]['position']==""){
    $position[0]['position']=1;
}

$source_title = XT::getTitleByContentType(XT::getValue('univctype'),XT::getValue('node_id'), $GLOBALS['plugin']->getActiveLang());

XT::query("insert into " . XT::getTable('relations') . " ( `id`, `lang`, `content_id`, `content_type`, `target_content_type`, `target_content_id`, `priority`, `title`,`target_title`, `description`, `image`, `type`, `position` )
values (  NULL,  '" . $GLOBALS['plugin']->getActiveLang() . "',  '" . XT::getValue('node_id') . "',  '" . XT::getValue('univctype') . "',  " . XT::getValue('ctype') . ",  " . XT::getValue('cid') . ",  '0',  '" . $source_title . "','" . $_REQUEST['ctitle'] . "',  NULL,  '0',  '0',  '" . $position[0]['position'] . "' )",__FILE__,__LINE__);

?>