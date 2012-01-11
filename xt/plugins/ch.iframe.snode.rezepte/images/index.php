<?php


if(!XT::getValue('recipe_id')){
    $GLOBALS['plugin']->setValue('recipe_id', XT::getSessionValue('recipe_id'));
}else{
    $GLOBALS['plugin']->setSessionValue('recipe_id',XT::getValue('recipe_id'));
}
if (!XT::getSessionValue('recipe_id')) {
    $GLOBALS['plugin']->setSessionValue('recipe_id', 0);
}

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
        images.image_id as id,
        images.image_version as version,
        fm.type,
        fm.width,
        fm.height,
        files.description as description
    FROM
        " . $GLOBALS['plugin']->getTable("images") . " as images
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_details") . " as files ON (files.id = images.image_id AND files.lang='" . XT::getLang() . "')
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files") . " as fm ON (fm.id = images.image_id)
    WHERE
        images.recipe_id = " . XT::getSessionValue('recipe_id')
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