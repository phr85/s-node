<?php
// Param :: Per_page
$per_page = XT::getParam("per_page") != "" ? XT::getParam("per_page") : $GLOBALS['plugin']->per_page;

// Param :: Style
$style = XT::getParam("style") != "" ? XT::getParam("style") : "default.tpl";

// Param :: Show_fields
$show_fields = XT::getParam("show_fields") != "" ? XT::getParam("show_fields") : "";

// Param :: Show_sets
$show_sets = XT::getParam("show_sets") != "" ? XT::getParam("show_sets") : "";



$nodefilter = XT::getSessionValue('nodefilter');
if(is_array($nodefilter)){
    foreach ($nodefilter as $field => $value) {
        if($value != 'not'){
            $filter_setted = true;
            $articlenodefilter = " tar.node_id=" . $value . " AND ";
            
        }
    }
}

$filter = XT::getSessionValue('filter');
if(is_array($filter)){
    foreach ($filter as $field => $value) {
        if($value != 'not'){
            $filter_setted = true;
            $articlefilter .= "
            INNER JOIN " . XT::getTable("fields_values") . " as vals" . $field . " ON (vals" . $field . ".field_id=" . $field . " AND vals" . $field . ".value='" . $value . "' AND vals" . $field . ".article_id = ad.id AND vals" . $field . ".lang='de') ";
        }
    }
}
if($filter_setted){

    /**
 * Check page variable
 */
    if (XT::getValue("page") != "") {
        XT::setSessionValue("page", XT::getValue("page"));
    }

    $result = XT::query("
        SELECT 
            COUNT(DISTINCT(main.id)) as count
        FROM 
            " . XT::getTable("articles_details") . " as ad 
        LEFT JOIN
            " . XT::getTable("tree2articles") . " as tar ON(tar.article_id = ad.id) LEFT JOIN
            " . XT::getTable("images") . " as img ON (img.article_id = ad.id AND img.is_main_image = 1) LEFT JOIN
            " . XT::getTable("articles") . " as main ON(main.id = ad.id) 
            " . $articlefilter . "
        WHERE
            " . $articlenodefilter . "
            ad.lang='" . $GLOBALS['lang']->getLang() . "' AND
            ad.active=1"
    , __FILE__, __LINE__);

    /**
 * Get num rows
 */
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

    $result = XT::query("
        SELECT
            ad.id,
            img.image_id,
            img.image_version,
            ad.title,
            ad.lead,
            ad.description,
            ad.subtitle,
            ad.active,
            main.quantity,
            main.art_nr,
            tar.node_id
        FROM
            " . XT::getTable("articles_details") . " as ad LEFT JOIN
            " . XT::getTable("tree2articles") . " as tar ON(tar.article_id = ad.id) LEFT JOIN
            " . XT::getTable("images") . " as img ON (img.article_id = ad.id AND img.is_main_image = 1) LEFT JOIN
            " . XT::getTable("articles") . " as main ON(main.id = ad.id)
            " . $articlefilter . "
        WHERE
            " . $articlenodefilter . " 
            ad.lang='" . $GLOBALS['lang']->getLang() . "' AND
            ad.active=1
        ORDER by
            tar.position asc
            
        LIMIT " . $limiter
    ,__FILE__,__LINE__);


    /**
 * Get Data
 */
    $data = array();

    while ($row = $result->fetchRow()) {
        $data[$row['id']] = $row;
    }

    if ($show_fields != "") {
        $field_articles = implode(',', array_keys($data));

        if ($field_articles != "") {
            $result = XT::query("
		  SELECT
            	f.article_id,
            	fn.title,
            	fn.type,
            	f.display,
            	f.field_id
          FROM
            	" . XT::getTable("fields_rel") . " as f 
          LEFT JOIN
            	" . XT::getTable("fields") . " as fn ON (f.field_id = fn.id)
          WHERE
            	f.article_id IN (" . $field_articles . ") AND
            	f.field_id IN (" . $show_fields . ") AND
            	f.lang = '" . XT::getLang() . "' AND
            	fn.lang = '" . XT::getLang() . "'
          ORDER BY
            	f.article_id,
            	fn.title
          ASC
		",__FILE__,__LINE__,XT::getParam("debug_sql"));

            $fields = array();

            while($row = $result->fetchRow()) {
                $fields[$row['article_id']][$row['field_id']]['title'] = $row['title'];
                $fields[$row['article_id']][$row['field_id']]['display'] = $row['display'];
                $fields[$row['article_id']][$row['field_id']]['type'] = $row['type'];
            }
            // values
            $result = XT::query("
		  SELECT
		      article_id,
		      field_id,
		      position,
              value,
              label
              
          FROM
            	" . XT::getTable("fields_values") . "
          WHERE
            	article_id IN (" . $field_articles . ") AND
            	field_id IN (" . $show_fields . ") AND
            	lang = '" . XT::getLang() . "'
          ORDER BY
            	article_id
          ASC
		",__FILE__,__LINE__);

            while($row = $result->fetchRow()) {
                if($fields[$row['article_id']][$row['field_id']]['type'] == 4 || $fields[$row['article_id']][$row['field_id']]['type'] == 5){
                    $fields[$row['article_id']][$row['field_id']]['data'][$row['position']]['value'] = $row['value'];
                    $fields[$row['article_id']][$row['field_id']]['data'][$row['position']]['label'] = $row['label'];
                }
            }
        }
    }

    if ($show_sets == "yes") {
        $sets_articles = implode(',', array_keys($data));

        if ($sets_articles != "") {
            $result = XT::query("
            SELECT
                sets.main_article_id,
            	det.id,
            	det.title,
            	det.subtitle,
            	det.lead,
            	det.description
            FROM
            	" . XT::getTable("articles_set") . " as sets LEFT JOIN
            	" . XT::getTable("articles_details") . " as det ON (sets.article_id = det.id)
            WHERE
            	sets.main_article_id IN (" . $sets_articles . ")
            AND
                det.active = 1
    	",__FILE__,__LINE__);

            $sets = array();

            while ($row = $result->fetchRow()) {
                $sets[$row['main_article_id']][] = $row;
            }
        }
    }

    XT::assign("FIELDS", $fields);
    XT::assign("SETS", $sets);
    XT::assign("PRODUCTS", $data);

    // Build content
    $content = XT::build($style);
}
?>