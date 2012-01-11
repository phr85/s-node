<?php
$node_id = XT::getValue("node_id") == "" ? 0 : XT::getValue("node_id");

$lang = XT::getValue("save_lang") == "" ? XT::getPluginLang() : XT::getValue("save_lang");

$result = XT::query("
            SELECT count(*) as cnt FROM
                " . XT::getTable("events_tree_details") . "
            WHERE
                node_id=" . $node_id . " AND
                lang='" . $lang . "'
          ",__FILE__,__LINE__);

$row = $result->fetchRow();

if ($row['cnt'] == 0) {
	$result = XT::query("
	   SELECT 
            isFolder,
            public
       FROM
            " . XT::getTable("events_tree_details") . "
       WHERE
            node_id=" . $node_id 
	,__FILE__,__LINE__);
	
	$row = $result->fetchRow();
	
	XT::query("
	   INSERT INTO
	       " . XT::getTable("events_tree_details") . "
       (node_id, lang, isFolder, public,creation_date, creation_user) VALUES
       (" . $node_id . ", '" . $lang . "', " . $row['isFolder'] . ", " . $row['public'] . ", " . time() . ", " . XT::getUserID() . ")
	",__FILE__,__LINE__);
}

XT::query("
    UPDATE
        " . XT::getTable("events_tree_details") . "
    SET
        title = '" . (XT::getValue("title")) . "',
        description = '" . (XT::getValue("description")) . "'
    WHERE
        node_id=" . $node_id . " AND
        lang='" . $lang . "'"
,__FILE__,__LINE__);

?>