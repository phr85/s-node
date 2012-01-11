<?php

$GLOBALS['plugin']->contribute('edit_node_buttons','Save', 'saveNode','disk_blue.png','0');
$lang = XT::getValue("save_lang") == "" ? XT::getPluginLang() : XT::getValue("save_lang");

XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", XT::getPluginLang());

$result = XT::query("
    SELECT
        node_id,
        title,
        description,
        active
    FROM
        " . XT::getTable("events_tree_details") . "
    WHERE
        node_id = " . XT::getValue("node_id") . "
        AND lang = '" . $lang . "'
    ",__FILE__,__LINE__,0);

$data = array();
while($row = $result->fetchRow()){
    $data[] = $row;
}

XT::assign("NODE_ID", XT::getValue("node_id"));
XT::assign("NODE", $data[0]);

$content = XT::build("edit_node.tpl");

?>
