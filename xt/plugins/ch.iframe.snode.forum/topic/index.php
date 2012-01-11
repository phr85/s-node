<?php
XT::errormessages();
if(XT::getParam('forum_id') >0 && XT::getSessionValue('forum_id') == ""){
    XT::setSessionValue('forum_id',XT::getParam('forum_id'));
}
if(XT::getValue('forum_id') >0){
    XT::setSessionValue('forum_id',XT::getValue('forum_id'));
}
$forum_id = XT::getSessionValue('forum_id');

if(XT::getParam('topic_id') >0 && XT::getSessionValue('topic_id') == ""){
    XT::setSessionValue('topic_id',XT::getParam('topic_id'));
}
if(XT::getValue('topic_id') >0){
    XT::setSessionValue('topic_id',XT::getValue('topic_id'));
}
$topic_id = XT::getSessionValue('topic_id');

if(!is_numeric($forum_id)){
    XT::log("No forum selected",__FILE__,__LINE__,XT_ERROR);

}else{



    // Parameter :: Postings per page (Default: Config var)
    $per_page = XT::getParam('postings_per_page') > 0 ? XT::getParam('postings_per_page') : XT::getConfig('postings_per_page');

    // Parameter :: All Nodes open (Default: Config var)
    $all_nodes_open = XT::getParam('all_nodes_open') != '' ? XT::getParam('all_nodes_open') : XT::getConfig('all_nodes_open');

    XT::assign("ALL_NODES_OPEN", $all_nodes_open);

    // Get topic details
    $result = XT::query("
    SELECT
        a.id,
        a.title,
        a.forum_id,
        a.posting_count,
        b.username,
        b.id userid
    FROM
        " . XT::getTable('forum_topics') . " as a LEFT JOIN
        " . XT::getTable('user') . " as b ON (b.id = a.lastentry_user)
    WHERE
        a.id = '" . $topic_id . "'
",__FILE__,__LINE__);

    while($row = $result->FetchRow()){
        $topic = $row;
    }


    $catpermission = XT::getQueryData(XT::query("SELECT xt_forum_categories.id,
	xt_forum_categories.pid
FROM " . XT::getTable("forum_forums") . " INNER JOIN " . XT::getTable("forum_categories") . " ON xt_forum_forums.category_id = xt_forum_categories.id
	 INNER JOIN " . XT::getTable("forum_topics") . " ON xt_forum_topics.forum_id = xt_forum_forums.id
WHERE xt_forum_topics.id=" .$topic_id

    ,__FILE__,__LINE__));

    if(XT::getNodePermission($catpermission[0]['id'],'list',$catpermission[0]["pid"])){

        XT::assign('TOPIC',$topic);

        // Get forum details
        $result = XT::query("
    SELECT
        id,
        title,
        category_id
    FROM
        " . XT::getTable('forum_forums') . "
    WHERE
        id = '" . $topic['forum_id'] . "'
",__FILE__,__LINE__);

        while($row = $result->FetchRow()){
            $forum = $row;
        }

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
",__FILE__,__LINE__);

        while($row = $result->FetchRow()){
            $category = $row;
        }

        XT::assign('CATEGORY',$category);

        // Get postings count
        $result = XT::query("
    SELECT
        count(id) as count_id
    FROM
        " . XT::getTable('forum_postings') . "
    WHERE
        topic_id = '" . $topic['id'] . "' AND
        level < 3
",__FILE__,__LINE__);

        $row = $result->FetchRow();

        $postings_count = $row['count_id'];

        // count entries

        $pages['amount'] =ceil($row['count_id']/$per_page);

        $pages['entries'] = $row['count_id'];
        $pages['postings_per_page'] = XT::getConfig('postings_per_page');

        $paginator = XT::getSessionValue('paginator');
        if(!is_numeric($paginator['entries'])){
            $paginator['entries'] = 1;
        }

        if(XT::getValue('forum_id')>0){
            $paginator['entries']=1;
        }
        if(XT::getValue('page')>0){
            $paginator['entries']=XT::getValue('page');
        }
        if(XT::getValue('page')=="last"){
            $paginator['entries']=$pages['amount'];
        }

        $pagelimit = "limit " . (($paginator['entries'] * XT::getConfig('postings_per_page')) - XT::getConfig('postings_per_page')) . ", "
        . XT::getConfig('postings_per_page') . " ";


        //next
        if($paginator['entries']<$pages['amount']){
            $pages['next']=$paginator['entries']+1;
        }else{
            $pages['next']=1;
        }
        //prev
        if($paginator['entries']==1){
            $pages['prev']=$pages['amount'];
        }else{
            $pages['prev']=$paginator['entries'] - 1;
        }
        $pages['actual']=$paginator['entries'];
        $pages['last'] = $pages['amount'] ;
        $pages['first'] = 1;

        XT::setSessionValue('paginator',$paginator);
        XT::assign("PAGES",$pages);







        XT::assign("PAGES", $pages);

        if(XT::getPermission('moderate')){
            $activepostings ="";

        }else {
            $activepostings = "AND a.active=1";
        }

        $postings = array();
        $in = array();

        // Get Topic
        $result = XT::query("
    SELECT
        a.id,
        a.title,
        b.username,
        a.body,
        a.level,
        a.creation_date,
        b.creation_date as user_date,
        a.topic_id,
        a.pid,
        a.active,
        floor((a.r-a.l-1)/2) as subs,
        a.l,
        a.r,
        files.filesize,
        files.filename,
        files.type as filetype,
        a.upload_file_id
    FROM
        " . XT::getTable('forum_postings') . " as a
    LEFT JOIN
        " . XT::getTable('user') . " as b ON (b.id = a.creation_user)
    LEFT JOIN
        " . XT::getTable('files') . " as files ON (files.id = a.upload_file_id and a.upload_file_id !=0)
    WHERE
        a.topic_id = '" . $topic['id'] . "' AND
        a.level =1 " . $activepostings . "
    ORDER BY
        a.l ASC",__FILE__,__LINE__);
        $postings= XT::getQueryData($result);

        // Get postings
        $result = XT::query("
    SELECT
        a.id,
        a.title,
        b.username,
        a.body,
        a.level,
        a.creation_date,
        b.creation_date as user_date,
        a.topic_id,
        a.pid,
        a.active,
        floor((a.r-a.l-1)/2) as subs,
        a.l,
        a.r,
        files.filesize,
        files.filename,
        files.type as filetype,
        a.upload_file_id
    FROM
        " . XT::getTable('forum_postings') . " as a
    LEFT JOIN
        " . XT::getTable('user') . " as b ON (b.id = a.creation_user)
    LEFT JOIN
        " . XT::getTable('files') . " as files ON (files.id = a.upload_file_id and a.upload_file_id !=0)
    WHERE
        a.topic_id = '" . $topic['id'] . "' AND
        a.level =2 " . $activepostings . "
    ORDER BY
        a.l ASC
    " . $pagelimit . "
",__FILE__,__LINE__);


        unset($last_node);
        while($row = $result->FetchRow()){
            $postings[] = $row;
            $inarr=array();
            $inarr['id']=$row['id'];
            $inarr['l']=$row['l'];
            $inarr['r']=$row['r'];
            $in[]= $inarr;
            if($row['creation_date'] > $latest_time){
                $last_node = $row['id'];
                $latest_time = $row['creation_date'];
            }
        }

        XT::assign('POSTINGS',$postings);

        $sub_postings = array();


        foreach ($in as $subtopic) {
            // Get sub postings
            $result = XT::query("
        SELECT
            n1.id,
            n1.title,
            b.username,
            b.id as userid,
            n1.body,
            n1.level,
            n1.creation_date,
            n1.topic_id,
            n1.pid,
            n1.l,
            n1.r,
            n1.upload_file_id,
            files.filesize,
            files.filename,
            files.type as filetype,
            n1.active,
            floor((n1.r-n1.l-1)/2) as subs
            FROM
                 " . XT::getTable('forum_postings') . " AS n1
                 LEFT JOIN " . XT::getTable('user') . " as b ON (b.id = n1.creation_user)
                 , " . XT::getTable('forum_postings') . " AS n2
                 LEFT JOIN " . XT::getTable('files') . " as files ON (files.id = n2.upload_file_id and n2.upload_file_id !=0)

            WHERE
                n2.id =" . $subtopic['id'] . "
                AND n1.topic_id=" . $topic['id'] . "
                AND n2.topic_id=" . $topic['id'] . "
                AND n1.l > " . $subtopic['l'] . "
                AND n1.r < " . $subtopic['r'] . "
                AND n1.level >2
            ORDER BY
                n1.l ASC

    ",__FILE__,__LINE__);

            $last_l = 0;
            $last_r = 0;
            while($row = $result->FetchRow()){
                $sub_postings[$subtopic['id']][] = $row;


            }
            XT::assign("SUB_POSTINGS", $sub_postings);
        }

        // Update topic
        XT::query("
    UPDATE
        " . XT::getTable('forum_topics') . "
    SET
        view_count = view_count+1
    WHERE
        id = '" . $topic['id'] . "'
",__FILE__,__LINE__);


        // Fetch content
        if($GLOBALS['plugin']->getParam("style") != ""){
            $style = $GLOBALS['plugin']->getParam("style");
        }else{
            $style = "default.tpl";
        }
        $content = XT::build($style);

        // Unnotifiy user
        if( XT::getUserID() > 0 && $_SESSION['notify']['topic'][$topic_id] == false){
            XT::query("update " . XT::getTable('forum_notification') . " set `notified`='0' where `topic_id`='" . $topic_id . "' AND
    user_id=" . XT::getUserID() . " AND type=0" ,__FILE__,__LINE__);
            $_SESSION['notify']['topic'][$topic_id] = true;
        }
    }else {
        $content = XT::translate("Access denied");
    }

}
?>