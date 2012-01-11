<?php
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('forum_forums') . " SET active = 0 WHERE id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

// deactivate topics and postings of this forum in search
if(XT::getConfig('searchindex')){
    XT::loadClass("searchindex.class.php","ch.iframe.snode.search");

    $search = new XT_SearchIndex(1,1,XT::getConfig('public'),XT::getConfig('searchengine'));
    if(XT::getConfig('searchengine')!='global'){
        $search->setSys();
    }
    // get all topics
    $result = XT::query("SELECT t.id as topic,p.id as posting from " . XT::getTable('forum_topics') . " as t left join " . XT::getTable('forum_postings') . " as p on (t.id=p.topic_id) WHERE t.forum_id=" . XT::getValue('id') . " and p.active=1 and t.active=1",__FILE__,__LINE__);
    while($row = $result->FetchRow()){
        $elements[$row['topic']][$row['posting']] =1;
    }
    foreach ($elements as $topic => $postings) {
        $search->nextDocument($topic, $GLOBALS['plugin']->getContentType("Forum Topic"));
        $search->disable();
        foreach ($postings as $posting => $val) {
            $search->nextDocument($posting, $GLOBALS['plugin']->getContentType("Forum Entry"));
            $search->disable();
        }
    }
}

?>