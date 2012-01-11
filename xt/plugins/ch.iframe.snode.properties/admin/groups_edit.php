<?php
XT::addImageButton('Save','saveGroup','default','save.png','0','slave1');

XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

/**
 * Get group data
 */
$result = XT::query("
    SELECT
        group_id as id,
        lang,
        title,
        description
    FROM
        " . XT::getTable("pgroups_details") . "
    WHERE
        group_id=" . XT::getValue("group_id") . " AND
        lang='" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);
$row = $result->fetchRow();
XT::assign("GROUP",$row);

/**
 * Get fields_rel
 */
$result = XT::query("

SELECT
    prop.id,
	prop.content_type,
	prop.position,
	prop.type,
	details.title,
	details.description
FROM " . XT::getTable("properties") . " as prop INNER JOIN " . XT::getTable("details") . " as details ON (prop.id = details.property_id AND details.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
	 INNER JOIN " . XT::getTable("prop2group") . " as relation ON relation.property_id = prop.id
WHERE relation.group_id = " . XT::getValue("group_id") . "
        ORDER BY prop.position ASC"
,__FILE__,__LINE__);

$data = XT::getQueryData($result);
XT::assign("PROPERTIES", $data);

$ids = array();

foreach ($data as $field) {
    $ids[] = $field['id'];
}
$ids = trim(implode(',', $ids));

if ($ids == "") {
    $ids = "0";
}


$result = XT::query("
SELECT
prop.id,
	details.title,
	details.lang,
	prop.position
FROM " . XT::getTable("properties") . " as prop INNER JOIN " . XT::getTable("details") . " as details ON prop.id = details.property_id
WHERE
details.lang='" . $GLOBALS['plugin']->getActiveLang() . "' AND
prop.id NOT IN(" . $ids . ")
ORDER BY
prop.position ASC
",__FILE__,__LINE__);

while ($row = $result->fetchRow()) {
    if($row['title'] != "")
    $fieldnames[$row['id']] = $row['position'] . " - " . $row['title'];
}

XT::assign("UNASSIGNEDPROPERTIES", $fieldnames);
$content = XT::build("groups_edit.tpl");
?>