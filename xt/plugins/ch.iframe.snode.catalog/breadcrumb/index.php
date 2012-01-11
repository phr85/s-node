<?php

/**
 * Parameter :: Style (Template)
 */

// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

if($GLOBALS['plugin']->getValue("node") != ''){
    $node_id = $GLOBALS['plugin']->getValue("node");
}else{
    if($GLOBALS['plugin']->getSessionValue("node") != ''){
        $node_id = $GLOBALS['plugin']->getSessionValue("node");
    }else {
        $node_id = 1;
    }
}

if(XT::getValue('node') !=''){
    XT::setSessionValue('node',$node_id);
}

// Get the way
$result = XT::query("
            SELECT 
                n1.id,
                n3.title,
                n3.subtitle,
                n3.image
                
            FROM
                " . $GLOBALS['cfg']->get("database","prefix") . "catalog_tree AS n1,
                " . $GLOBALS['cfg']->get("database","prefix") . "catalog_tree AS n2 LEFT JOIN 
                " . $GLOBALS['cfg']->get("database","prefix") . "catalog_tree_nodes AS n3 ON (n3.node_id = n1.id AND n3.lang = '" . $GLOBALS['lang']->getLang() . "')
            WHERE
                n2.id ='" . XT::getSessionValue('node') . "'
                AND n1.l <= n2.l
                AND n1.r >= n2.r
                AND n1.level > 1
            GROUP BY
                n1.ID
            ORDER BY
                n1.l ASC
        ",__FILE__,__LINE__);
$count = 0;
while ($row = $result->FetchRow()){
    $way[$count]['id'] = $row['id'];
    $way[$count]['title'] = $row['title'];
    if($row['image']>0){
        $way[$count]['image']=$row['image'];
        $image = $row['image'];
    }else{
    	$way[$count]['image']=$image;
    }
    
    $count++;
}
XT::assign('LASTIMAGE',$image);

if(is_numeric(XT::getParam("target_tpl"))){
    XT::assign('TARGET_TPL',XT::getParam("target_tpl"));
}else {
	XT::assign('TARGET_TPL',XT::getTemplateID());
}

XT::assign("WAY", $way);

$content = XT::build($style);

?>