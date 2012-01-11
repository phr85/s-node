<?php
if(XT::getParam('target_type') != ""){
    $target_type = ' AND content_type=' . XT::getParam('target_type');
}else {
    $stop = true;
}

if(XT::getParam('source_type') != ""){
    $source_type = 'target_content_type=' . XT::getParam('source_type');
}else {
    $stop = true;
}

if(XT::getParam('source_id') != ""){
    $source_id = ' AND target_content_id=' . XT::getParam('source_id');
}else {
    $in = "";
    if(is_array($GLOBALS['relations'][XT::getParam('source_type')])){
        foreach ($GLOBALS['relations'][XT::getParam('source_type')] as $key => $value) {
            $in .= "," . $key;
        }
        if($in!=''){
            $source_id = ' AND target_content_id IN(' . substr($in,1) . ")";
        }
    }else{
        $stop = true;
    }
}

if(!$stop){
    $result = XT::query("SELECT rel.* FROM " . XT::getTable('relations') . " as rel
WHERE "
    . $source_type
    . $source_id
    . $target_type
    . "  ORDER by position "
    ,__FILE__,__LINE__);

    XT::assign("DATA", XT::getQueryData($result));


    // Fetch content
    if($GLOBALS['plugin']->getParam("style") != ""){
        $style = $GLOBALS['plugin']->getParam("style");
    }else{
        $style = "default.tpl";
    }
    $content = XT::build($style);
}
?>