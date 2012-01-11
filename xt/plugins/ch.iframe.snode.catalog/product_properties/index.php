<?php
if(!$GLOBALS['plugin']->getValue('article_id')){
    $GLOBALS['plugin']->setValue('article_id', $GLOBALS['plugin']->getSessionValue('article_id'));
}else{
    $GLOBALS['plugin']->setSessionValue('article_id',$GLOBALS['plugin']->getValue('article_id'));
}

// Parameter :: group
$group = $GLOBALS['plugin']->getParam('group') != '' ? $GLOBALS['plugin']->getParam('group') : '';

// Parameter :: Range
$range = $GLOBALS['plugin']->getParam('range') != '' ? $GLOBALS['plugin']->getParam('range') : false;

// Parameter :: Show
$range_type = $GLOBALS['plugin']->getParam('range_type') != '' ? $GLOBALS['plugin']->getParam('range_type') : '';

// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

// Parameter :: Article ID
$article_id = $GLOBALS['plugin']->getParam('article_id') != '' ? $GLOBALS['plugin']->getParam('article_id') : XT::getSessionValue('article_id');



$range = trim($range);

if($group != ''){
    $range = '0';
    $result = XT::query("SELECT field_id FROM " . XT::getTable('fieldgroups_rel') . " WHERE fieldgroup_id=" . $group,__FILE__,__LINE__);
    while($row = $result->fetchRow()) {
        $range .= ',' . $row['field_id'];
    }
    $result = XT::query("SELECT name FROM " . XT::getTable('fieldgroups') . " WHERE id=" . $group . " AND lang='" . XT::getLang() . "'",__FILE__,__LINE__);
    while($row = $result->fetchRow()) {
        $title = $row['name'];
    }

}

// Parameter :: $title
$title = $GLOBALS['plugin']->getParam('title') != '' ? $GLOBALS['plugin']->getParam('title') : $title;

if($range_type == 'not') {
    $expression = 'NOT IN';
}
else {
    $expression = 'IN';
}
if ($range == '') {
    $range = '0';
}

$roles = implode(XT::getRoles(),',');
if($roles == ""){
    $roles = '0';
}

$result = XT::query("
            SELECT
                fields.id,
            	fields.title,
            	fields.description,
            	props.display,
            	fields.type,
            	props.article_id,
            	props.field_id
            FROM
            	" . XT::getTable("fields") . " as `fields`
            LEFT JOIN
                " . XT::getTable("fields_roles") . " as perm on (perm.field_id = fields.id AND perm.lang='" . XT::getLang() . "'),
            	" . XT::getTable("fields_rel") . " as props
            WHERE
            	props.article_id = " . $article_id . "
            AND
            	props.field_id = fields.id
        	AND
        	   props.field_id " . $expression . " (" . $range . ")
        	AND
        	   fields.lang='" . XT::getLang() . "'
        	AND
        	   props.lang='" . XT::getLang() . "'
            AND
               (perm.role_id is NULL OR perm.role_id in (" . $roles . "))
            ORDER BY fields.position ASC"
, __FILE__, __LINE__);

$range = '0';
while($row = $result->fetchRow()) {
    $fields[$row['field_id']]['title'] = $row['title'];
    $fields[$row['field_id']]['display'] = $row['display'];
    $fields[$row['field_id']]['type'] = $row['type'];
    $range .= ',' . $row['field_id'];
}

// values
$result = XT::query("
		  SELECT
		      article_id,
		      field_id,
		      position,
              value,
              label

          FROM
            	" . XT::getTable("fields_values") . "
          WHERE
            	article_id = " . $article_id . "
          AND
        	    field_id " . $expression . " (" . $range . ")
          AND
            	lang = '" . XT::getLang() . "'
          ORDER BY
            	article_id
          ASC
		",__FILE__,__LINE__);

while($row = $result->fetchRow()) {
        $fields[$row['field_id']]['data'][$row['position']]['value'] = $row['value'];
        $fields[$row['field_id']]['data'][$row['position']]['label'] = $row['label'];
}

XT::assign("GROUP_TITLE", $title);
XT::assign('PROPS', $fields);
XT::assign("ARTICLE_TITLE", $row['title']);

$content = XT::build($style);
?>