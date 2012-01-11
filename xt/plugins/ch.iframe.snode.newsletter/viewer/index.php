<?php

// Ensure that the data array is empty
$data = array();

// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

// Parameter :: ID
$id = $GLOBALS['plugin']->getParam('id') != '' ? $GLOBALS['plugin']->getParam('id') : $GLOBALS['plugin']->getValue('id');

$sql = "
    SELECT
       *
    FROM
        " . XT::getTable('newsletter') . "
	WHERE
	   lang = '" . $GLOBALS['lang']->getLang() . "'
	AND id=" . $id . "";

$result = XT::query($sql,__FILE__,__LINE__);

while($row = $result->FetchRow()){
	foreach($row as $key=>$val) {
		$data[$key] = $val;
	}
	/*
    XT::assign("TITLE", $row['title']);
    XT::addToTitle($row['title']);
    XT::addToContentStack(XT::getContentType('Newsletter'),$row['id'], $row['title']);*/
}

// Chapters
$result = XT::query("SELECT * from " . XT::getTable("newsletter_chapters") . " 
WHERE id = " . $id . " ORDER by level ASC",__FILE__,__LINE__);
$data['chapters'] = XT::getQueryData($result);

// Assign the data to the template
XT::assign("xt" . XT::getBaseID() . "_viewer", $data);

$content = XT::build($style);
?>
