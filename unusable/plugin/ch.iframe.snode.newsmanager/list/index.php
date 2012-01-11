<?php
// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

// Parameter :: Linking
$link2details = $GLOBALS['plugin']->getParam('link2details') != '' ? $GLOBALS['plugin']->getParam('link2details') : 'no';

// Parameter :: Category
$category = $GLOBALS['plugin']->getParam('categories') != '' ? $GLOBALS['plugin']->getParam('categories') : '0';

// Parameter :: Target
$target_tpl = $GLOBALS['plugin']->getParam('target_tpl') != '' ? $GLOBALS['plugin']->getParam('target_tpl') : '194';

// Parameter :: Count
$count = $GLOBALS['plugin']->getParam('count') != '' ? $GLOBALS['plugin']->getParam('count') : '5';

// Parameter :: Mode
$mode = $GLOBALS['plugin']->getParam('mode') != '' ? $GLOBALS['plugin']->getParam('mode') : 'normal';


if($category != '0') {

    $result = XT::query("
        SELECT 
            news_id
        FROM
            " . XT::getTable('newsmanager_tree_rel') . "
        WHERE 
            node_id IN (" . $category . ")", __FILE__, __LINE__);


    while ($row = $result->fetchRow()) {
        $ids .=  ', ' . $row['news_id'];
    }
}
$ids = 0 . $ids;


switch ($mode) {
    case 'normal':
    $sql = "
    SELECT
        n.id,
        n.title,
        n.subtitle,
        n.introduction,
        n.creation_date,
        n.active,
        n.image,
        n.image_version,
        m.description as img_description
    FROM
        " . XT::getTable('newsmanager') . " as n LEFT JOIN 
        " . XT::getTable('files_details') . " as m ON (m.id = n.image AND m.lang = '" . XT::getLang() . "')
    WHERE
        n.active = 1 AND
        n.lang = '" . XT::getLang() . "'";
    if($ids != '0'){
        $sql .= " AND n.id IN (" . $ids . ") ";
    }
    $sql .= " ORDER BY
        n.creation_date DESC
    LIMIT
        " . $count;
    break;

    default:
    $sql = "
    SELECT
        n.id,
        n.title,
        n.creation_date,
        n.active,
        n.image,
        n.image_version,
        m.description as img_alt,
        m.description as img_description
    FROM
        " . XT::getTable('newsmanager') . " as n LEFT JOIN 
        " . XT::getTable('files_details') . " as m ON (m.id = n.image AND m.lang = '" . XT::getLang() . "')
    WHERE
        n.active = 1 AND
        n.lang = '" . XT::getLang() . "'
        ";
    if($ids != '0'){
        $sql .= " AND n.id IN (" . $ids . ") ";
    }
    $sql .= " ORDER BY
        n.creation_date DESC
    LIMIT
        " . $count;

}


// SQL
$result = XT::query($sql,__FILE__,__LINE__);

XT::assign("LINK2DETAILS", $link2details);
XT::assign("TARGET_TPL", $target_tpl);
XT::assign("DATA", XT::getQueryData($result));
XT::assign("ADMIN_TPL", $GLOBALS['plugin']->getConfig('admin_tpl'));

$content = XT::build($style);

?>
