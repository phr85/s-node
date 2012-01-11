<?php


if(XT::getParam('topic_id') >0 && XT::getSessionValue('topic_id') == ""){
    XT::setSessionValue('topic_id',XT::getParam('topic_id'));
}
if(XT::getValue('topic_id') >0){
    XT::setSessionValue('topic_id',XT::getValue('topic_id'));
}
$topic_id = XT::getSessionValue('topic_id');


// Get reply to details
$result = XT::query("
    SELECT
        a.id,
        a.title,
        a.topic_id,
        b.username,
        a.body
    FROM
        " . XT::getTable('forum_postings') . " as a LEFT JOIN
        " . XT::getTable('user') . " as b ON (b.id = a.creation_user)
    WHERE
        a.id = '" . XT::getValue('alert_id') . "'
",__FILE__,__LINE__);

while($row = $result->FetchRow()){
    $posting = $row;
}

XT::assign("POSTING", $posting);

// Get forum details
$result = XT::query("
    SELECT
        id,
        title,
        forum_id
    FROM
        " . XT::getTable('forum_topics') . "
    WHERE
        id = '" . $posting['topic_id'] . "'
",__FILE__,__LINE__);

while($row = $result->FetchRow()){
    $topic = $row;
}

XT::assign('TOPIC',$topic);

// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);

?>