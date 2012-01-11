<?php
//echo '<pre>' . print_r($_POST, true) . '</pre>';

// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

// Parameter :: fields 
$property = $GLOBALS['plugin']->getParam('property') != '' ? $GLOBALS['plugin']->getParam('property') : 0;


// Get all fields
$result = XT::query("
SELECT prop.value
FROM
" . XT::getTable("articles_details")  . " as art, " . XT::getTable("fields_values")  . " as prop
WHERE
prop.article_id = art.id
AND
prop.field_id=" . $property . "
AND
prop.lang='" . XT::getLang() . "'
AND
art.lang='" . XT::getLang() . "'
AND
art.active=1
group by
prop.value",__FILE__,__LINE__);



XT::assign('DROPDOWN', XT::getQueryData($result));
XT::assign('TITLE', XT::getParam('title'));
XT::assign('PROPERTY', $property);

$prop = XT::getSessionValue('filter');

if (XT::getValue('property_' . $property) != ''){
    $prop[$property]=XT::getValue('property_' . $property);
    XT::setSessionValue('filter',$prop);
}

XT::assign('SELECTED',$prop[$property]);

$content = XT::build($style);

?>