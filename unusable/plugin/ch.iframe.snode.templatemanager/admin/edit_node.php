<?php

$GLOBALS['plugin']->contribute('edit_node_buttons','Save', 'saveNode','','0');

XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$result = XT::query("
    SELECT
        node_id,
        title,
        description
    FROM
        " . $GLOBALS['plugin']->getTable("faq_tree_details") . "
    WHERE
        node_id = " . $GLOBALS['plugin']->getValue("node_id") . "
        AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    ",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("NODE_ID", $GLOBALS['plugin']->getValue("node_id"));
XT::assign("NODE", $data[0]);

$content = XT::build("edit_node.tpl");

?>
