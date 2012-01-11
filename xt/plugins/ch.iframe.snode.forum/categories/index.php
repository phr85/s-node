<?php
XT::errormessages();
    // Get categories
    $result = XT::query("
        SELECT

            det.*,
            tree.*
        FROM
            " . XT::getTable('forum_categories') . " as tree LEFT JOIN
            " . XT::getTable('forum_categories_details') . " as det on (det.node_id = tree.id)
        WHERE
            tree.level > 1 AND
            det.active = 1
        ORDER BY
            tree.l ASC
    ",__FILE__,__LINE__);

    $categories = array();
    $category_in = array();
    while($row = $result->FetchRow()){
        if( $row['public'] == 1 || XT::getNodePermission($row['id'],'list',$row['pid'])){

        $categories[] = $row;
        $category_in[] = $row['id'];
        }
    }

    XT::assign('CATEGORIES',$categories);
if(count($category_in) > 0){
    // Get forums
    $result = XT::query("
        SELECT
            a.id,
            a.title,
            a.description,
            a.category_id,
            a.topic_count,
            a.posting_count,
            a.lastentry_user,
            a.lastentry_date,
            a.lastentry_topic,
            b.username
        FROM
            " . XT::getTable('forum_forums') . " as a LEFT JOIN
            " . XT::getTable('user') . " as b ON (b.id = a.lastentry_user)
        WHERE
            category_id IN (" . implode(',',$category_in) . ")
        ORDER BY
            title ASC
    ",__FILE__,__LINE__);

    $forums = array();
    while($row = $result->FetchRow()){
        $forums[$row['category_id']][] = $row;
    }

    XT::assign('FORUMS',$forums);
}
// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);

?>