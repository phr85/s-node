<?php

$result = XT::query("SELECT node.* FROM " . XT::getTable('relations') . " as rel 
LEFT JOIN " . XT::getTable('nodes') . " as node on (rel.content_id = node.node_id AND node.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
WHERE rel.content_type =" . XT::getBaseID() . " AND rel.target_content_type=" . $_REQUEST['ctype'] . " AND rel.target_content_id=" . $_REQUEST['cid'] . " 
",__FILE__,__LINE__);
XT::assign("DATA", XT::getQueryData($result));
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());


XT::assign("CTITLE", $_REQUEST['ctitle']);
XT::assign("CTYPE", $_REQUEST['ctype']);
XT::assign("CID", $_REQUEST['cid']);

$content = XT::build("default.tpl");
?>
