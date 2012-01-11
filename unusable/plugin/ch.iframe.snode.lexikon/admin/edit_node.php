<?php

XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$result = XT::query("
    SELECT
        node_id,
        title,
        description,
        subtitle,
        use_description
    FROM
        " . $GLOBALS['plugin']->getTable("nodes") . "
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
