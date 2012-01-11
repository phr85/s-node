<?php

// Parameter :: slideshow
if(XT::getParam('slide') != ''){
    $slideshow = XT::getParam('slide');

    // Parameter :: Style
    $style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

    // get slideshow details
    $result = XT::query("
    SELECT
       id, title, loop, random, active
    FROM
        " . $GLOBALS['plugin']->getTable("autopilot") . " 
    WHERE
        id = '" . $slideshow . "'
    ",__FILE__,__LINE__);

    $slide = XT::getQueryData($result);
    // do only if slideshow is active
    if($slide[0]['active']==1){
        
        //random, loop
        $random = XT::getParam('random') != '' ? XT::getParam('random') : $slide[0]['random'];
        $loop = XT::getParam('loop') != '' ? XT::getParam('loop') : $slide[0]['loop'];

        // get slides
        if($random==1){
            $sql="SELECT page, duration, page_type FROM " . $GLOBALS['plugin']->getTable("autopilot_data") . " WHERE active=1 AND id=" . $slideshow . " ORDER BY RAND()";
        }else{
            $sql="SELECT page, duration, page_type FROM " . $GLOBALS['plugin']->getTable("autopilot_data") . " WHERE active=1 AND id=" . $slideshow . " ORDER BY position asc";
        }
        $result = XT::query($sql,__FILE__,__LINE__);
        $timeline = 100;
        while($row = $result->FetchRow()){
            $row['timeline'] = $timeline;
            $timeline += ($row['duration'] * 1000);
            $data[] = $row;
        }
        
        XT::assign('LOOP', $loop);
        XT::assign('LOOPTIME', $timeline);
        XT::assign("SLIDES",$data);
        XT::assign('TITLE',$slide[0]['title']);
        $content = XT::build($style);
    }
}
?>
