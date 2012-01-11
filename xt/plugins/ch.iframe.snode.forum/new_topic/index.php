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
        id,
        title
    FROM
        " . XT::getTable('forum_forums') . "
    WHERE
        id = '" . $forum_id . "'
    ",__FILE__,__LINE__,0);

    while($row = $result->FetchRow()){
        $forum = $row;
    }

    XT::assign('FORUM',$forum);

    // Fetch content
    if($GLOBALS['plugin']->getParam("style") != ""){
        $style = $GLOBALS['plugin']->getParam("style");
    }else{
        $style = "default.tpl";
    }
    $content = XT::build($style);
}
?>