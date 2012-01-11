<?php
$result = XT::query("SELECT
        atr.node_id as node,
        atr.position as nodepos,
        ad.id,
        ad.title,
        ad.lead,
        a.art_nr,
        a2t.position,
        a2t.article_id,
        i.image_id

        FROM
            " . XT::getTable('articles_details') . " as ad
        LEFT JOIN
            " . XT::getTable('articles_relations') . " as a2t on (a2t.article_id = ad.id)
        LEFT JOIN
            " . XT::getTable('images') . "  as i on (i.article_id = ad.id AND i.is_main_image = 1)
        LEFT JOIN
            " . XT::getTable('articles') . " as a on (a.id = ad.id)
        LEFT JOIN 
            " . XT::getTable('tree2articles') . " as atr on(atr.article_id = a.id)
        WHERE
            a2t.main_article_id=" . XT::autoval("article_id", "R", 0) . "
         AND
            ad.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        ORDER BY
            a2t.position ASC",__FILE__, __LINE__,0);

while($row = $result->fetchRow()) {
    
    $tmp['title'] = $row['title'];
    $tmp['id'] = $row['id'];
    $tmp['lead'] = $row['lead'];
    $tmp['art_nr'] = $row['art_nr'];
    $tmp['nodepos'] = $row['nodepos'];
    $tmp['position'] = $row['position'];
    $tmp['image_id'] = $row['image_id'];
    $tmp['node'] = $row['node'];
    
    $relations[$row['id']][]=$tmp;
    
}
XT::assign("RELATIONS", $relations);


// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);

?>
