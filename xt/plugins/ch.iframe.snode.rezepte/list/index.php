<?php
// Param :: Per_page
$per_page = XT::getParam("per_page") != "" ? XT::getParam("per_page") : $GLOBALS['plugin']->per_page;
// Param :: Style
$style = XT::getParam("style") != "" ? XT::getParam("style") : "default.tpl";
// Param :: Show_fields
$show_fields = XT::getParam("show_fields") != "" ? XT::getParam("show_fields") : "";
// Param :: Show_sets
$show_sets = XT::getParam("show_sets") != "" ? XT::getParam("show_sets") : "";



/**
 * Parameter :: node (int => default is 1)
 */
if(XT::getValue("node") != ''){
    $node_id = XT::getValue("node");
}else{
    if(XT::getSessionValue("node") != ''){
        $node_id = XT::getSessionValue("node");
    }else {
        $node_id = 1;
    }
}

if($GLOBALS['plugin']->getParam("node") != ''){
    $node_id = $GLOBALS['plugin']->getParam("node");
}
XT::setSessionValue('node',$node_id);

$result = XT::query("SELECT t1.id from " . XT::gettable("tree") . " as t1 , " . XT::gettable("tree") . " as t2 WHERE
    t2.id=" . $node_id . "
AND
    t1.l >= t2.l
AND
    t1.r <= t2.r" ,__FILE__,__LINE__);

while ($row = $result->fetchRow()) {
        $innodearray[] = $row['id'];
    }


if(XT::getValue("filter")!=""){
    
    require_once(CLASS_DIR . "search.class.php");
    $search = new XT_Search(1,1000,"global");
    $search->enableSoundex(true);
    $search->setLang($GLOBALS["lang"]->getLang());
    $search->setContentType(5700);
    $inarray = $search->search_id(XT::getValue("filter"));
    XT::assign("NUMOFSEARCHRESULTS", $search->resultCount);
    
    $filterarray = explode(" " , XT::getValue("filter"));
    foreach ($filterarray as $key => $value) {
    	 if($search->soundexed[$key+1]['replacement']!=""){
    	     
    	     $filterarray[$key] = $search->soundexed[$key+1]['replacement'];
    	 }
    }
    XT::assign("FILTER", implode(" ",$filterarray));
    
}else{
    $inarray = false;
}

if($inarray){
    $searchfilter = " AND ad.id in(" .  implode(",",$inarray) . ")";
    XT::loadClass("ordering.class.php","ch.iframe.snode.core");
    $order = new XT_Order("main.id,main.rating_avg","main.id",-1,"livelist");
    $order->setListener("sort","sortby");

    $result = XT::query("
        SELECT
            main.*,
            img.image_id,
            img.image_version,
            ad.title,
            ad.description,
            ad.subtitle,
            ad.active,
            ad.recipe_of_month,
            ad.validated
        FROM
            " . XT::getTable("r_details") . " as ad LEFT JOIN
            " . XT::getTable("r2tree") . " as tar ON(tar.recipe_id = ad.id) LEFT JOIN
            " . XT::getTable("images") . " as img ON (img.recipe_id = ad.id AND img.is_main_image = 1) LEFT JOIN
            " . XT::getTable('rezepte') . " as main ON(main.id = ad.id)
        WHERE
            ad.lang='" . $GLOBALS['lang']->getLang() . "' AND
            ad.active=1 AND ad.validated = 1 AND
            tar.node_id in (" . implode(",",$innodearray) . ")" .
    $searchfilter . " "
    . $order->get() . "
            , tar.position asc"
    ,__FILE__,__LINE__);

    $data = array();

    while ($row = $result->fetchRow()) {
        $row['rating_avg_img'] = number_format(round(2 * $row['rating_avg'])/2,1,'_',"");
        $data[$row['id']] = $row;
    }

    XT::assign("PRODUCTS", $data);

}else{







    /**
 * Check page variable
 */
    if (XT::getValue("page") != "") {
        XT::setSessionValue("page", XT::getValue("page"));
    }
    $result = XT::query("
        SELECT
             COUNT(DISTINCT main.id) as count
        FROM
            " . XT::getTable("r_details") . " as ad LEFT JOIN
            " . XT::getTable("r2tree") . " as tar ON(tar.recipe_id = ad.id) LEFT JOIN
            " . XT::getTable("images") . " as img ON (img.recipe_id = ad.id AND img.is_main_image = 1) LEFT JOIN
            " . XT::getTable('rezepte') . " as main ON(main.id = ad.id)
        WHERE
            ad.lang='" . $GLOBALS['lang']->getLang() . "' AND
            ad.active=1 AND
            tar.node_id in (" . implode(",",$innodearray) . ")"
    , __FILE__, __LINE__);

    $data = $result->fetchRow();
    $row_count = $data['count'];
    $page_count = ceil($row_count / $per_page);
    $pages = array();

    /**
 * Create pages
 */
    for($i=1; $i <= $page_count; $i++){
        $pages[$i] = 1;
    }

    /**
 * Check session values
 */
    if (XT::getSessionValue("page") != "") {
        $active_page = XT::getSessionValue("page");

        if($active_page > $page_count){
            $active_page = $page_count;
            XT::setSessionValue("page", $active_page);
        }

        if($active_page < 1){
            XT::setSessionValue("page", 1);
        } else {
            XT::setSessionValue("page", $active_page);
        }
    }
    else {
        $active_page = 1;
    }


    /**
 * Assig tpl vars
 */
    XT::assign("TOTAL_COUNT", $row_count);   // Total entry count
    XT::assign("ACTIVE_PAGE", $active_page); // Active page
    XT::assign("PAGES", $pages);             // All the pages
    XT::assign("PAGE_COUNT", $page_count);   // Total page count
    XT::assign("PAGE_START", ($active_page-1)*$per_page+1);

    if(($active_page-1) * $per_page + $per_page < $row_count){
        XT::assign("PAGE_END", ($active_page-1)*$per_page + $per_page);
    } else {
        XT::assign("PAGE_END", $row_count);
    }

    // Build limit
    if(($active_page-1)*$per_page >= 0){
        $limiter = ($active_page-1)*$per_page . "," . $per_page;
    } else {
        $limiter = "0," . $per_page;
    }
    XT::loadClass("ordering.class.php","ch.iframe.snode.core");
    $order = new XT_Order("main.id,main.rating_avg","main.id",-1,"livelist");
    $order->setListener("sort","sortby");


    $result = XT::query("
        SELECT
            DISTINCT main.*,
            img.image_id,
            img.image_version,
            ad.title,
            ad.description,
            ad.subtitle,
            ad.active,
            ad.recipe_of_month,
            ad.validated
        FROM
            " . XT::getTable("r_details") . " as ad LEFT JOIN
            " . XT::getTable("r2tree") . " as tar ON(tar.recipe_id = ad.id) LEFT JOIN
            " . XT::getTable("images") . " as img ON (img.recipe_id = ad.id AND img.is_main_image = 1) LEFT JOIN
            " . XT::getTable('rezepte') . " as main ON(main.id = ad.id)
        WHERE
            ad.lang='" . $GLOBALS['lang']->getLang() . "' AND
            ad.active=1 AND ad.validated = 1 AND
            tar.node_id in (" . implode(",",$innodearray) . ")"
    . $order->get() . "
            , tar.position asc
        LIMIT " . $limiter
    ,__FILE__,__LINE__);

    $data = array();

    while ($row = $result->fetchRow()) {
        $row['rating_avg_img'] = number_format(round(2 * $row['rating_avg'])/2,1,'_',"");
        $data[$row['id']] = $row;
    }

    XT::assign("PRODUCTS", $data);
}

$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable("nodes") . "
    WHERE
        node_id = " . XT::getSessionValue('node') . " AND
        lang='" . $GLOBALS['lang']->getLang() . "'
    ",__FILE__,__LINE__);


// Empty data array and fill data into it
$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}
XT::assign("NODE", $data[0]);

// Build content
$content = XT::build($style);
?>