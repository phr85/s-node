<?php
// include tables and property types config
include_once(PLUGIN_DIR . "ch.iframe.snode.relations/includes/config.ext.inc.php");
if($GLOBALS['plugin']->getValue('XT_REL_relation_id') != 0){
	$result = XT::query("SELECT * FROM " . XT::getTable('relations') . " WHERE id=" . XT::getValue('XT_REL_relation_id'),__FILE__,__LINE__);
	$row = $result->FetchRow();
	$pos = $row['position'];
	$target_content_id = $row['target_content_id'];
	$target_content_type = $row['target_content_type'];
	
	$result = XT::query("UPDATE " . XT::getTable('relations') . " SET position= " . $pos . " WHERE position =" . ($pos - 1) . " AND target_content_id=" . $target_content_id . " AND target_content_type=" . $target_content_type,__FILE__,__LINE__);
	$result = XT::query("UPDATE " . XT::getTable('relations') . " SET position= " . ($pos - 1) . " WHERE id =" .  XT::getValue('XT_REL_relation_id'),__FILE__,__LINE__);
	
	// Clean up 
	$result = XT::query("SELECT * FROM " . XT::getTable('relations') . " WHERE target_content_id=" . $target_content_id . " AND target_content_type=" . $target_content_type . " ORDER BY position ASC",__FILE__,__LINE__);
	$i = 1;
	while($row = $result->FetchRow()){
		XT::query("UPDATE " . XT::getTable('relations') . " SET position= " . $i . " WHERE id =" .  $row['id'],__FILE__,__LINE__);
		$i++;
	}
}

?>
