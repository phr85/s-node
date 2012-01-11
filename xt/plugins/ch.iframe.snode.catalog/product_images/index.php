<?php

// Parameter :: article_id
$article_id = XT::autoval("article_id", "R", 0);

// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

// Parameter :: Show
$show = $GLOBALS['plugin']->getParam('show') != '' ? $GLOBALS['plugin']->getParam('show') : '';

// Parameter :: Version
$version = $GLOBALS['plugin']->getParam('version') != '' ? $GLOBALS['plugin']->getParam('version') : '4';

switch ($show) {
    case 'main':
        $showmain = ' AND images.is_main_image = 1';
        break;
    case 'rest':
        $showmain = ' AND images.is_main_image = 0';
        break;
    case 'random':
        $rand = ' RAND(), ';
        break;
    default:
        break;
}

$result = XT::query("
    SELECT
        images.*,
        fm.type,
        fm.width,
        fm.height,
        files.title,
        files.description,
        files.keywords
    FROM
    	" . $GLOBALS['plugin']->getTable("images") . " as images
    LEFT JOIN
    	" . $GLOBALS['plugin']->getTable("files_details") . " as files ON (files.id = images.image_id AND files.lang='" . XT::getLang() . "')
    LEFT JOIN
    	" . $GLOBALS['plugin']->getTable("files") . " as fm ON (fm.id = images.image_id)
    WHERE
    	images.article_id = " . $article_id
     . $showmain . "
    ORDER BY
    " . $rand . "
        images.position ASC"
,__FILE__, __LINE__);

$images = XT::getQueryData($result);

XT::assign('VERSION', $version);
XT::assign('IMAGES', $images);

$content = XT::build($style)

?>