<?php
$settings = XT::getConfig('settings');

XT::loadClass('tree.class.php','ch.iframe.snode.core');
$tree = new XT_Tree('forum_postings');
$thread = $tree->showDelete(XT::getValue('thread_id'));

// deactivate topics and postings of this forum in search
if(XT::getConfig('searchindex')){
    XT::loadClass("searchindex.class.php","ch.iframe.snode.search");

    $search = new XT_SearchIndex(1,$GLOBALS['plugin']->getContentType("Forum Topic"),XT::getConfig('public'),XT::getConfig('searchengine'));
    if(XT::getConfig('searchengine')!='global'){
        $search->setSys();
    }
    foreach ($thread as $msg) {
        $search->nextDocument($msg['id'], $GLOBALS['plugin']->getContentType("Forum Entry"));
        $search->disable();
        XT::query("UPDATE " . XT::getTable('forum_postings') . " SET active = 0 WHERE id = '" . $msg['id'] . "'",__FILE__,__LINE__);
    }
}

// forum themen und beiträge runterzählen
// Update forum
XT::query("
        UPDATE
            " . XT::getTable('forum_topics') . "
        SET
             posting_count = posting_count-1
        WHERE
            forum_id = '" . XT::getSessionValue('forum_id') . "'
        AND
            id='" . XT::getValue('topic_id') . "'
        ",__FILE__,__LINE__);

XT::query("
        UPDATE
            " . XT::getTable('forum_forums') . "
        SET
             posting_count = posting_count-1
        WHERE
            id = '" . XT::getSessionValue('forum_id') . "'
        ",__FILE__,__LINE__);

 

//delete from Topics table (if topic is deleted)
if(XT::getValue('topic_id') && XT::getValue('is_topic')){
    $search->nextDocument(XT::getValue('topic_id'), $GLOBALS['plugin']->getContentType("Forum Topic"));
    $search->disable();
}

?>