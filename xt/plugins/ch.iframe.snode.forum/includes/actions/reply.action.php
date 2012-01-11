<?php
$settings = XT::getConfig('settings');

if(!checkPost(XT::getValue('title'),XT::getValue('body'))){
    XT::log("Error in DATA",__FILE__,__LINE__,XT_ERROR);
}else{
    XT::loadClass('tree.class.php','ch.iframe.snode.core');
    $tree = new XT_Tree('forum_postings');
    $newid = $tree->addChildNode(XT::getValue('reply_to'));

    XT::setValue("newid",$newid);

    // load abbc class
    XT::loadClass("abbc/abbc.lib.php");
    $body = abbc_proc(stripslashes(XT::getValue('body')));



    // Insert entry
    XT::query("
    UPDATE
        " . XT::getTable('forum_postings') . "
    SET
        topic_id = '" . XT::getValue('topic_id') . "',
        creation_date = " . time() . ",
        creation_user = '" . XT::getUserID() . "',
        title = '" . XT::getValue('title') . "',
        active = '" . XT::getConfig('activeposting') . "',
        body = '" . addslashes($body) . "'
    WHERE
        id = '" . $newid . "'
",__FILE__,__LINE__);

    if(XT::getConfig('activeposting')==0){
        XT::call('alertPosting');
    }

    // Update topic
    XT::query("
    UPDATE
        " . XT::getTable('forum_topics') . "
    SET
        posting_count = posting_count+1,
        lastentry_user = '" . XT::getUserID() . "',
        lastentry_date = " . time() . "
    WHERE
        id = '" . XT::getValue('topic_id') . "'
",__FILE__,__LINE__);

    // Update forum
    XT::query("
    UPDATE
        " . XT::getTable('forum_forums') . "
    SET
        posting_count = posting_count+1,
        lastentry_user = '" . XT::getUserID() . "',
        lastentry_date = " . time() . ",
        lastentry_topic = " . XT::getValue('topic_id') . "
    WHERE
        id = '" . XT::getValue('forum_id') . "'
",__FILE__,__LINE__);

    // save uploaded file
    XT::call("saveUploadedFile");

    if(XT::getConfig('searchindex')){
        XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
        $search = new XT_SearchIndex($newid,$GLOBALS['plugin']->getContentType("Forum Entry"),XT::getConfig('public'),XT::getConfig('searchengine'));
        if(XT::getConfig('searchengine')!='global'){
            $search->setSys();
        }

        $search->add(XT::getValue("body"), 1);
        $description = strlen(XT::getValue('body')) > 250 ? substr(strip_tags(XT::getValue("body")),0,250) . '...' : strip_tags(XT::getValue('body'));
        $search->build(XT::getValue("title"), $description);
    }
    // register notifier
    if(XT::getValue('mail')=='on'){
        XT::call('notification');
    }
    // notifie users in this topics
    XT::call('notify');
}

 header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $settings['topic']['TPL'] . "&x" . $GLOBALS['plugin']->getBaseID() . "_topic_id=" . XT::getValue('topic_id') . "#bottom");

?>