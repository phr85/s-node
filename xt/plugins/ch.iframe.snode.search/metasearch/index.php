<?php
// auf "-" überprüfen, sonst normale suche starten
if(strstr(XT::getValue('term'), "-")) {
    $sdaterange = explode("-", XT::getValue('term'));
    
    if($sdaterange[0]!=""){
        $sdaterangetsfirst_pre = explode(".",$sdaterange[0]);
        $sdaterangetsfirst = mktime(0,0,0,$sdaterangetsfirst_pre[1],$sdaterangetsfirst_pre[0],$sdaterangetsfirst_pre[2]);
    }else{
        $sdaterangetsfirst = 'NULL';
    }
    
    if($sdaterange[1]!=""){
        $sdaterangetssecond_pre = explode(".",$sdaterange[1]);
        $sdaterangetssecond = mktime(0,0,0,$sdaterangetssecond_pre[1],$sdaterangetssecond_pre[0],$sdaterangetssecond_pre[2]);
    }else{
        $sdaterangetssecond = 'NULL';
    }
    
    // get the results (IDs)
    $result = XT::query("SET OPTION SQL_BIG_SELECTS = 1");
    $result = XT::query("SELECT info.*
        FROM " . XT::getTable("search_infos_global","de") . " as info
        INNER JOIN xt_files_rel as frel ON(info.content_id = frel.file_id)
        WHERE info.content_type=240
        AND info.manual_date BETWEEN '" . $sdaterangetsfirst . "' AND '" . $sdaterangetssecond . "'
        AND frel.node_id=47
            ",__FILE__,__LINE__);
    
        $i=0;
        while($row = $result->FetchRow()){
            $found[$i]     = $row;
    
            $i++;
            $results ++;
        }

    $GLOBALS['tpl']->assign("SEARCHTERM", XT::getValue("Term"));
    $GLOBALS['tpl']->assign("RESULTS", $found);
    $GLOBALS['tpl']->assign("TOTAL", $results);
    
    // Fetch content
    if($GLOBALS['plugin']->getParam("style") != ""){
        $style = $GLOBALS['plugin']->getParam("style");
    }else{
        $style = "default.tpl";
    }
        
    XT::assign("ELAPSED_TIME", $time);
    
    $content = XT::build($style);
    
} else {
    
    // Datum in Timestamp umwandeln
    if(XT::getValue('term')!=""){
        $sdate_pre = explode(".",XT::getValue('term'));
        $sdate = mktime(0,0,0,$sdate_pre[1],$sdate_pre[0],$sdate_pre[2]);
    }else{
         $sdate = 'NULL';
    }
    if(XT::getValue("term") !=""){
        // get the results (IDs)
        $result = XT::query("SET OPTION SQL_BIG_SELECTS = 1");
        $result = XT::query("SELECT info.*
            FROM " . XT::getTable("search_infos_global","de") . " as info
            WHERE info.content_type=240
            AND info.manual_date like '%" . $sdate . "%'
    
            ",__FILE__,__LINE__);
    
        $i=0;
        while($row = $result->FetchRow()){
            $found[$i]     = $row;
    
            $i++;
            $results ++;
        }
    }
    $GLOBALS['tpl']->assign("SEARCHTERM", XT::getValue("Term"));
    $GLOBALS['tpl']->assign("RESULTS", $found);
    $GLOBALS['tpl']->assign("TOTAL", $results);
    
    // Fetch content
    if($GLOBALS['plugin']->getParam("style") != ""){
        $style = $GLOBALS['plugin']->getParam("style");
    }else{
        $style = "default.tpl";
    }
        
    XT::assign("ELAPSED_TIME", $time);
    $content = XT::build($style);
    
}

?>