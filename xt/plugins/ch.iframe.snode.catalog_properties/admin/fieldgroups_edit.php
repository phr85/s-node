<?php  

    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

/**
 * Get group data
 */
$result = XT::query("
    SELECT
        id,
        lang,
        name,
        description
    FROM
        " . XT::getTable("fieldgroups") . "
    WHERE
        id=" . XT::getSessionValue("fieldgroup_id") . " AND
        lang='" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);
$row = $result->fetchRow();
XT::assign("GROUP",$row);

/**
 * Get fields_rel
 */
$result = XT::query("
    SELECT
        gl.field_id,
        fn.title,
        fn.description,
        fn.position
    FROM
        " . XT::getTable("fieldgroups_rel") . " as gl LEFT JOIN 
        " . XT::getTable("fields") . " as fn
        ON(gl.field_id=fn.id)
    WHERE
        fn.lang='" . $GLOBALS['plugin']->getActiveLang() . "' AND
        gl.fieldgroup_id=" . XT::getSessionValue("fieldgroup_id") . "
        ORDER BY fn.position ASC"
,__FILE__,__LINE__);

$data = XT::getQueryData($result);
XT::assign("ARTICLEFIELDS", $data);

$ids = array();

foreach ($data as $field) {
	$ids[] = $field['field_id'];
}
$ids = trim(implode(',', $ids));

if ($ids == "") {
	$ids = "0";
}


$result = XT::query("
    SELECT
        id,
        title,
        position
    FROM
        " . XT::getTable("fields") . "
    WHERE
        lang='" . $GLOBALS['plugin']->getActiveLang() . "' AND
        id NOT IN(" . $ids . ")
    ORDER BY
    position ASC
",__FILE__,__LINE__);

while ($row = $result->fetchRow()) {
    if($row['title'] != "")
	$fieldnames[$row['id']] = $row['position'] . " - " . $row['title'];
}

XT::assign("FIELDNAMES", $fieldnames);
$content = XT::build("fieldgroups_edit.tpl");
?>