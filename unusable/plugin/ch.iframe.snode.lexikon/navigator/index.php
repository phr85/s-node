<?php



// set And get session values
if(!$GLOBALS['plugin']->getValue('article_id')){
    $GLOBALS['plugin']->setValue('article_id', $GLOBALS['plugin']->getSessionValue('article_id'));
}else{
    $GLOBALS['plugin']->setSessionValue('article_id',$GLOBALS['plugin']->getValue('article_id'));
}
if($GLOBALS['plugin']->getParam("visible_range") < 3){
    $visible_range = 3;
}else{
    $visible_range = $GLOBALS['plugin']->getParam("visible_range");
}


// get a node if node is not given
$node_id = $GLOBALS['plugin']->getSessionValue('node_id');
if($node_id == 1){
    $result = XT::query("
        SELECT
            ap.node_id
        FROM
            " . $GLOBALS['plugin']->getTable("tree2articles") . " as ap
        WHERE
            ap.article_id = " . $GLOBALS['plugin']->getSessionValue('article_id') . "
        LIMIT 1
    ",__FILE__,__LINE__,$GLOBALS['plugin']->getParam("debug_sql"));

    while($row = $result->FetchRow()){
        $GLOBALS['plugin']->setSessionValue('node_id',$row['node_id']);
    }
}


if($GLOBALS['plugin']->getValue('article_id') || $GLOBALS['plugin']->getSessionValue('article_id')){
    $result = XT::query("
        SELECT
            ap.node_id,
            ap.article_id,
            ap.position,
            ad.id,
            ad.title,
            ad.lang
        FROM
            " . $GLOBALS['plugin']->getTable("tree2articles") . " as ap
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable("articles_details") . " as ad ON (ap.article_id = ad.id AND ad.lang='" . $GLOBALS['lang']->getLang() . "')
        WHERE
            ap.node_id = " . $GLOBALS['plugin']->getSessionValue('node_id') . "
        ORDER by
            ap.position asc
    ",__FILE__,__LINE__,$GLOBALS['plugin']->getParam("debug_sql"));

    while($row = $result->FetchRow()){
        $PRODUCTS[] = $row;
        if($row['article_id'] == $GLOBALS['plugin']->getSessionValue('article_id')) {
            $NAVIGATOR['position'] = $row['position'];
        }
    }



    $NAVIGATOR['prev'] = false;
    $NAVIGATOR['next'] = false;
    $start = ($NAVIGATOR['position'] - ($visible_range -1) / 2) -1;
    $end = ($NAVIGATOR['position'] + ($visible_range -1) / 2) ;
    $maxpos = count($PRODUCTS);
    if($end >= $maxpos){
        $start = $maxpos - $visible_range;
        $end   = $visible_range;
    }else{
        $end   = $visible_range;
    }


    if($start <= 0){
        $start = 0;
        $end   = $visible_range;
    }
    if($NAVIGATOR['position'] > $visible_range){
        $NAVIGATOR['prev'] = true;
        $NAVIGATOR['prev_id'] = $PRODUCTS[$NAVIGATOR['position']-$visible_range - 1]['id'];
        $NAVIGATOR['prev_title'] = $PRODUCTS[$NAVIGATOR['position']-$visible_range -1 ]['title'];
    }

    if($NAVIGATOR['position'] <= ($maxpos - $visible_range)){
       $NAVIGATOR['next'] = true;
        $NAVIGATOR['next_id'] = $PRODUCTS[$NAVIGATOR['position']+$visible_range - 1]['id'];
        $NAVIGATOR['next_title'] = $PRODUCTS[$NAVIGATOR['position']+$visible_range -1 ]['title'];
    }

    $PRODUCTS = array_slice($PRODUCTS, $start, $end);
    XT::assign("NAVIGATOR", $NAVIGATOR);
    XT::assign("PRODUCTS", $PRODUCTS);

    // Fetch content
    if($GLOBALS['plugin']->getParam("style") != ""){
        $style = $GLOBALS['plugin']->getParam("style");
    }else{
        $style = "default.tpl";
    }
    $content = XT::build($style);
}else{
    $content = 'required value (article_id) not available';
}
?>
