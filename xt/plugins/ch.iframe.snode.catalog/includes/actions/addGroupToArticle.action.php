<?php
XT::setAdminModule('ea');
XT::call('saveArticle');

$result = XT::query("
    SELECT
         field_id as id
    FROM
        " . XT::getTable("fields_rel") . "
    WHERE
        lang='" . $GLOBALS['plugin']->getActiveLang() . "' AND
        article_id = " . XT::getValue("id") 
,__FILE__,__LINE__);

$ids = array();

while ($row = $result->fetchRow()) {
	$ids[] = $row['id'];
}

$ids = implode(',', $ids);

if ($ids == '') {
	$ids = 0;
}

$result = XT::query("
    SELECT
        field_id as id
    FROM
        " . XT::getTable("fieldgroups_rel") . "
    WHERE
        fieldgroup_id=" . XT::getValue("fieldgroup_id") . " AND
        field_id NOT IN(" . $ids . ")
",__FILE__,__LINE__);

$ids = XT::getQueryData($result);

foreach ($ids as $id) {
	XT::query("
	   INSERT INTO 
	       " . XT::getTable("fields_rel") . "
            (article_id, lang, field_id)
       VALUES
            (" . XT::getValue("id") . ", '" . $GLOBALS['plugin']->getActiveLang() . "'," . $id['id'] . ")
	",__FILE__,__LINE__);

XT::query("INSERT INTO
               " . $GLOBALS['plugin']->getTable('fields_values') . "
           (article_id, lang, field_id, position, value)
           VALUES
               (
               " . XT::getValue("id") . ",
               '" . $GLOBALS['plugin']->getActiveLang() . "',
               " . $id['id'] . ",
               1,
               NULL
               )"
      ,__FILE__,__LINE__);
}

?>