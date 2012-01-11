<?PHP

// History
$history = XT::getSessionValue("history");


if($history[0]['link'] != $_SERVER['REQUEST_URI']){

    if(XT::getParam("link")!=""){
        $newhistory[0]['link']= XT::getParam("link");
    }else{
        $newhistory[0]['link']= $_SERVER['REQUEST_URI'];
    }

    if(XT::getParam("title")!=""){
        $newhistory[0]['title']= XT::getParam("title");
    }else{
        $newhistory[0]['title']= str_replace($GLOBALS['cfg']->get("system", "base_meta_title"),"",$GLOBALS['pagetitle']);
    }

    $newhistory[0]['method']= $_SERVER['REQUEST_METHOD'];
    $newhistory[0]['time']= TIME;
}

if(is_array($history)){
    foreach ($history as $visitedpages) {
        $newhistory[] = $visitedpages;
        $i++;
        if($i == XT::getConfig("numOfElements")){
            break(1);
        }
    }
}
XT::setSessionValue("history",$newhistory);

if(XT::getParam("action")=="delete"){
    XT::unsetSessionValue("history");
}
?>