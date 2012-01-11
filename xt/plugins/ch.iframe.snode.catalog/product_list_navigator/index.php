<?php
// set And get session values
if(!XT::getValue('article_id')){
    XT::setValue('article_id', XT::getSessionValue('article_id'));
}else{
    XT::setSessionValue('article_id',XT::getValue('article_id'));
}
if(XT::getParam("visible_range") < 3){
    $visible_range = 3;
}else{
    $visible_range = XT::getParam("visible_range");
}

if (XT::getValue('article_id') == '') {
	if(XT::getSessionValue('article_id') == '') {
	    XT::setSessionValue('article_id', 0);
	}
}

if(is_numeric(XT::getParam("target_tpl"))){
    XT::assign('TARGET_TPL',XT::getParam("target_tpl"));
}else {
	XT::assign('TARGET_TPL',XT::getTemplateID());
}

// get a node if node is not given
$node_id = XT::getSessionValue('node');
if($node_id == 1 || empty($node_id)){
    
    $result = XT::query("
        SELECT
            ap.node_id
        FROM
            " . XT::getTable("tree2articles") . " as ap
        WHERE
            ap.article_id = " . XT::getSessionValue('article_id') . "
        LIMIT 1
    ",__FILE__,__LINE__,XT::getParam("debug_sql"));

    while($row = $result->FetchRow()){
        XT::setSessionValue('node',$row['node_id']);
        $node_id = $row['node_id'];
    }
}


if(XT::getValue('article_id') || XT::getSessionValue('article_id')){
    $result = XT::query("
        SELECT
            ap.node_id,
            ap.article_id,
            ap.position,
            ad.id,
            ad.title,
            ad.lang
        FROM
            " . XT::getTable("tree2articles") . " as ap,
        
            " . XT::getTable("articles_details") . " as ad
        WHERE
            ap.node_id = " . XT::getSessionValue('node') . "
            AND (ap.article_id = ad.id AND ad.lang='" . $GLOBALS['lang']->getLang() . "' AND ad.active = 1)
        ORDER by
            ap.position asc
    ",__FILE__,__LINE__,XT::getParam("debug_sql"));
    $position = 1;
    while($row = $result->FetchRow()){
        $PRODUCTS[$position]['node_id']    = $row['node_id'];
        $PRODUCTS[$position]['article_id'] = $row['article_id'];
        $PRODUCTS[$position]['id']         = $row['id'];
        $PRODUCTS[$position]['title']      = $row['title'];
        $PRODUCTS[$position]['lang']       = $row['lang'];
        $PRODUCTS[$position]['position']   = $position;

        if($row['article_id'] == XT::getSessionValue('article_id')) {
            $NAVIGATOR['position'] = $position;
        }
        $last = $position;
        $position++;
    }
    if(is_array($PRODUCTS)){

        // prev first next last

        $NAVIGATOR['first_id'] = $PRODUCTS[1]['id'];
        $NAVIGATOR['first_title'] = $PRODUCTS[1]['title'];
        $NAVIGATOR['prev_id'] = $PRODUCTS[$NAVIGATOR['position'] -1]['id'];
        $NAVIGATOR['prev_title'] = $PRODUCTS[$NAVIGATOR['position'] -1]['title'];
        $NAVIGATOR['next_id'] = $PRODUCTS[$NAVIGATOR['position'] +1]['id'];
        $NAVIGATOR['next_title'] = $PRODUCTS[$NAVIGATOR['position'] +1]['title'];
        $NAVIGATOR['last_id'] = $PRODUCTS[$last]['id'];
        $NAVIGATOR['last_title'] = $PRODUCTS[$last]['title'];

        $NAVIGATOR['prev_block'] = false;
        $NAVIGATOR['next_block'] = false;
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
            $NAVIGATOR['prev_block'] = true;
            $NAVIGATOR['prev_block_id'] = $PRODUCTS[$NAVIGATOR['position']-$visible_range - 1]['id'];
            $NAVIGATOR['prev_block_title'] = $PRODUCTS[$NAVIGATOR['position']-$visible_range -1 ]['title'];
        }

        if($NAVIGATOR['position'] <= ($maxpos - $visible_range)){
            $NAVIGATOR['next_block'] = true;
            $NAVIGATOR['next_block_id'] = $PRODUCTS[$NAVIGATOR['position']+$visible_range - 1]['id'];
            $NAVIGATOR['next_block_title'] = $PRODUCTS[$NAVIGATOR['position']+$visible_range -1 ]['title'];
        }

        $PRODUCTS = array_slice($PRODUCTS, $start, $end);
        XT::assign("NAVIGATOR", $NAVIGATOR);
        XT::assign("PRODUCTS", $PRODUCTS);

        // Fetch content
        if(XT::getParam("style") != ""){
            $style = XT::getParam("style");
        }else{
            $style = "default.tpl";
        }
        $content = XT::build($style);
    }else{
        $content = 'required value (article_id) not available';
    }
}
?>
