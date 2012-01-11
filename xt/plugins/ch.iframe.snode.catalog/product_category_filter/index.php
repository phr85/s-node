<?php
//echo '<pre>' . print_r($_POST, true) . '</pre>';

// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

// Parameter :: fields 
$node = $GLOBALS['plugin']->getParam('node') != '' ? $GLOBALS['plugin']->getParam('node') : 0;

// Get all fields
$result = XT::query("
SELECT dets.node_id as id, dets.title
FROM
" . XT::getTable("tree")  . " as tree 
LEFT JOIN " . XT::getTable("nodes")  . " as dets ON (tree.id = dets.node_id and dets.lang='" . XT::getLang() . "')
WHERE
tree.pid = " . $node . "
ORDER BY tree.l ASC
",__FILE__,__LINE__);

XT::assign('DROPDOWN', XT::getQueryData($result));
XT::assign('TITLE', XT::getParam('title'));
XT::assign('category', $category);

$prop = XT::getSessionValue('nodefilter');

if (XT::getValue('category_' . $category) != ''){
    $prop[0] = XT::getValue('category_' . $category);
    XT::setSessionValue('nodefilter',$prop);
}

XT::assign('SELECTED',$prop[$category]);

$content = XT::build($style);

?>