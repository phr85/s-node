<?php

$GLOBALS['plugin']->contribute('edit_relation_buttons','Save', 'saveRelation','disk_blue.png','0');
$GLOBALS['plugin']->contribute('edit_relation_buttons','Save and close', 'saveRelationAndClose','save_close.png','0');

// Get relation data
$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("relations") . "
    WHERE
        content_id = " . $GLOBALS['plugin']->getValue("project_id") . "
        AND content_type = " . $GLOBALS['plugin']->getContentType("Project") . "
        AND target_content_id = " . $GLOBALS['plugin']->getValue("target_content_id") . "
        AND target_content_type = " . $GLOBALS['plugin']->getValue("target_content_type") . "
    LIMIT 1
    ",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("RELATION", $data[0]);

// Get content types
$result = XT::query("
    SELECT * FROM " . $GLOBALS['plugin']->getTable("content_types") . "
    ORDER BY title ASC",__FILE__,__LINE__);

$types = array();
while($row = $result->FetchRow()){
    $types[$row['id']] = $row;
}

XT::assign("CONTENT_TYPES", $types);

// Get relation data
$result = XT::query("
    SELECT
        content_id,
        content_type,
        title,
        id
    FROM
        " . $GLOBALS['plugin']->getTable("search_infos_global") . "_" . $GLOBALS['plugin']->getActiveLang() . "
    WHERE
        content_type = " . $data[0]['target_content_type'] . "
",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("CONTENT_ELEMENTS", $data);

$content = XT::build("edit_relation.tpl");

?>
