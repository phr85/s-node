<?php
$result = XT::query("SELECT id, title FROM " . XT::getTable('contenttypes'),__FILE__,__LINE__);

while($row = $result->FetchRow()){
	$ctypes[$row['id']] = $row['title'];
}

XT::assign('CTYPES', $ctypes);
$result = XT::query("SELECT * FROM " . XT::getTable('relations') . " WHERE content_type=" . XT::getBaseID() . " AND content_id=" . XT::getValue('node_id') . " ORDER by position ASC",__FILE__,__LINE__);
XT::assign("DATA", XT::getQueryData($result));

$result= XT::query("SELECT * from " . XT::getTable('nodes') . " WHERE node_id=" . XT::getValue('node_id'), __FILE__,__LINE__);
$node = XT::getQueryData($result);
XT:: assign("NODE", $node[0]);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());
XT::assign("NODE_ID", XT::getValue('node_id'));

XT::addImageButton('Cleanup duplicate entries', 'cleanUpDuplicas','default',"refresh.png","relations");
XT::assign('BUTTONSDOWN',$GLOBALS['plugin']->getButtons('default'));

$content = XT::build("relations.tpl");
?>
