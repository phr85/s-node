<?php
$settings = XT::getConfig('settings');
if(XT::getValue('forum_id') >0){
    XT::setSessionValue('forum_id',XT::getValue('forum_id'));
}
$forum_id = XT::getSessionValue('forum_id');

if(!is_numeric($forum_id) || !checkPost(XT::getValue('body'),XT::getValue('body'))){
    XT::log("Error in DATA",__FILE__,__LINE__,XT_ERROR);
}else{
    
      // load abbc class
    XT::loadClass("abbc/abbc.lib.php");
   $body = abbc_proc( XT::getValue('body'));
    

    // Insert entry
    XT::query("
    INSERT INTO
        " . XT::getTable('forum_topics') . "
    (
        title,
        creation_date,
        creation_user,
        forum_id,
        lastentry_user,
        active,
        lastentry_date
    ) VALUES (
        '" . XT::getValue('title') . "',
        " . time() . ",
        '" . XT::getUserID() . "',
        " . $forum_id . ",
        '" . XT::getUserID() . "',
        '" . XT::getConfig('activeposting') . "',
        " . time() . "
    )
",__FILE__,__LINE__);

       
    // Get last insert id
    $result = XT::query("
    SELECT 
        id 
    FROM 
        " . XT::getTable("forum_topics") .  " 
    ORDER BY 
        id DESC 
    LIMIT 
        1
", __FILE__,__LINE__);

    while($row = $result->FetchRow()){
        $newid = $row['id'];
    }

    // alert
    if(XT::getConfig('activeposting')==0){
        XT::call('alertPosting');
    }
    
    // Insert root node for postings
    XT::query("
    INSERT INTO
        " . XT::getTable('forum_postings') . "
    (
        l,
        r,
        pid,
        level,
        title,
        body,
        creation_date,
        creation_user,
        tree_id,
        topic_id
    ) VALUES (
        1,
        2,
        0,
        1,
        '" . XT::getValue('title') . "',
        '" . addslashes($body) . "',
        " . time() . ",
        '" . XT::getUserID() . "',
        " . $newid . ",
        " . $newid . "
    )
",__FILE__,__LINE__);

    // Update forum
    XT::query("
    UPDATE
        " . XT::getTable('forum_forums') . "
    SET
        topic_count = topic_count+1,
        lastentry_user = '" . XT::getUserID() . "',
        lastentry_date = " . time() . ",
        lastentry_topic = " . $newid . "
    WHERE
        id = '" . $forum_id . "'
",__FILE__,__LINE__);

    if(XT::getConfig('searchindex')){
        XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
        $search = new XT_SearchIndex($newid,$GLOBALS['plugin']->getContentType("Forum Topic"),XT::getConfig('public'),XT::getConfig('searchengine'));
        if(XT::getConfig('searchengine')!='global'){
            $search->setSys();
        }

        $search->add(XT::getValue("body"), 1);
        $description = strlen(XT::getValue('body')) > 150 ? substr(strip_tags(XT::getValue("body")),0,150) . '...' : strip_tags(XT::getValue('body'));
        $search->build(XT::getValue("title"), $description);
    }
   XT::setSessionValue('topic_id',$newid);
   
   // notify users
   XT::call('notify_new_topic');
   header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $settings['topic']['TPL'] . "&x" . XT::getBaseID() . "_topic_id=" . $newid);
}
?>