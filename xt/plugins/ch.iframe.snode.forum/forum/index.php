<?php
XT::errormessages();
if(XT::getParam('forum_id') >0 && XT::getSessionValue('forum_id') == ""){
    XT::setSessionValue('forum_id',XT::getParam('forum_id'));
}
if(XT::getValue('forum_id') >0){
    XT::setSessionValue('forum_id',XT::getValue('forum_id'));
}
$forum_id = XT::getSessionValue('forum_id');
if(!is_numeric($forum_id)){
    XT::log("No forum selected",__FILE__,__LINE__,XT_ERROR);

}else{

    // Get forum details
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
            b.username
        FROM
            " . XT::getTable('forum_forums') . " as a LEFT JOIN
            " . XT::getTable('user') . " as b ON (b.id = a.lastentry_user)
        WHERE
            a.id = '" . $forum_id . "'
    ",__FILE__,__LINE__,0);

    while($row = $result->FetchRow()){
        $forum = $row;
    }

    $category = XT::getQueryData(XT::query("SELECT pid from " . XT::getTable("forum_categories") . " WHERE id=" . $forum['category_id'],__FILE__,__LINE__));

    if(XT::getNodePermission($forum['category_id'],'list',$category[0]["pid"])){

    XT::assign('FORUM',$forum);

    // Get forum details
    $result = XT::query("
        SELECT
            node_id as id,
            title
        FROM
            " . XT::getTable('forum_categories_details') . "
        WHERE
            node_id = '" . $forum['category_id'] . "'
            AND
            lang='" . XT::getLang() . "'
    ");

    while($row = $result->FetchRow()){
        $category = $row;
    }

    XT::assign('CATEGORY',$category);


    // count topics
    $result = XT::query("SELECT count(id) as cnt FROM " . XT::getTable('forum_topics') . " as a WHERE a.forum_id = '" . $forum['id'] . "'");
    $row = $result->FetchRow();
    if(is_int($row['cnt']/ XT::getConfig('postings_per_page'))){
        $pages['amount'] = $row['cnt']/ XT::getConfig('postings_per_page') ;
    }else{
        $pages['amount'] = intval($row['cnt']/ XT::getConfig('postings_per_page')) +1 ;
    }

    $pages['topics'] = $row['cnt'];
    $pages['postings_per_page'] = XT::getConfig('postings_per_page');

    $paginator = XT::getSessionValue('paginator');
    if(!is_numeric($paginator['topics'])){
        $paginator['topics'] = 1;
    }

    if(XT::getValue('page')>0){
        $paginator['topics']=XT::getValue('page');
    }

    $pagelimit = "limit " . (($paginator['topics'] * XT::getConfig('postings_per_page')) - XT::getConfig('postings_per_page')) . ", "
    . XT::getConfig('postings_per_page') . " ";


    //next
    if($paginator['topics']<$pages['amount']){
        $pages['next']=$paginator['topics']+1;
    }else{
        $pages['next']=1;
    }
    //prev
    if($paginator['topics']==1){
        $pages['prev']=$pages['amount'];
    }else{
        $pages['prev']=$paginator['topics'] - 1;
    }
    $pages['actual']=$paginator['topics'];
    $pages['last'] = $pages['amount'] ;
    $pages['first'] = 1;

    XT::setSessionValue('paginator',$paginator);
    XT::assign("PAGES",$pages);

    // Get topics
    $result = XT::query("
        SELECT
            a.id,
            a.title,
            b.username,
            c.username as lastentry,
            a.posting_count,
            a.lastentry_user,
            a.view_count,
            a.lastentry_date
        FROM
            " . XT::getTable('forum_topics') . " as a
        LEFT JOIN
            " . XT::getTable('user') . " as b ON (b.id = a.creation_user)
        LEFT JOIN
            " . XT::getTable('user') . " as c ON (c.id = a.lastentry_user)
        WHERE
            a.forum_id = '" . $forum['id'] . "'
        GROUP BY
            a.id
        ORDER BY
            a.lastentry_date DESC
        " . $pagelimit,__FILE__,__LINE__,0);

    $topics = array();
    while($row = $result->FetchRow()){
        $topics[] = $row;
    }

    XT::assign('TOPICS',$topics);


    }
    // Fetch content
    if($GLOBALS['plugin']->getParam("style") != ""){
        $style = $GLOBALS['plugin']->getParam("style");
    }else{
        $style = "default.tpl";
    }
    $content = XT::build($style);
}
?>