<?php

if(XT::getValue("node")){
    $node = XT::getValue("node");
    XT::setSessionValue("node",$node);
}else {
    if(XT::getSessionValue("node")){
        $node = XT::getSessionValue("node");
    }else {
        $node = XT::getParam('node') != '' ? XT::getParam('node') : NULL;
        XT::setSessionValue("node",$node);
    }
}

if(XT::getParam('target_baseid') != ""){
    $target_baseid = ' AND target_content_type=' . XT::getParam('target_baseid');
}

$result = XT::query("SELECT rel.* FROM " . XT::getTable('relations') . " as rel
LEFT JOIN " . XT::getTable('nodes') . " as node on (rel.content_id = node.node_id AND node.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
WHERE rel.content_type =" . XT::getBaseID() . "
AND rel.content_id = " . $node
. $target_baseid . "  ORDER by position "
,__FILE__,__LINE__);

while($row = $result->FetchRow()){
    $data[] = $row;
    $sorted_data[$row['target_content_type']][]=$row;
    $in[$row['target_content_type']][] = $row['target_content_id'];
}
XT::assign("DATA", $data);
XT::assign("SORTEDIDS", $in);
XT::assign("SORTEDDATA", $sorted_data);
XT::assign("NODE",$node);

// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);
?>