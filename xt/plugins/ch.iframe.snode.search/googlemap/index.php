<?php

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

$langarray = $GLOBALS['cfg']->getLangs();

foreach ($langarray as $lang => $val) {

    if($lang !="sys"){
        $time = " AND
        (a.valid_from = 0 OR a.valid_from < " . time() . ")
    AND
        (a.valid_until = 0 OR a.valid_until > " . time() . ")";
    }else {
        $time = "";
    }
    // langinfo noch machen
    // Get all pages
    $result = XT::query("
    SELECT
        a.*,
        b.open_url
    FROM
        " . XT::getDatabasePrefix() .  "search_infos_global_" . $lang . " as a LEFT JOIN
        " . XT::getDatabasePrefix() . "content_types as b ON (b.id = a.content_type)
    WHERE
        a.active = 1
    AND
        a.public = 1" . $time . "

    GROUP BY
        a.title
    ORDER BY
        a.title ASC
",__FILE__,__LINE__);

    while($row = $result->FetchRow()){
        if($row['ext_link'] == NULL){
            $row['url'] = str_replace('%id%',$row['content_id'],$row['open_url']);
        }else{
            $row['url'] = $row['ext_link'];
        }


        if(substr($row['url'],0,1)=="?"){
            $row['url'] = "/index_" . $lang . ".php" . $row['url'];
        }

        // url immer mit / beginnen
        if(substr($row['url'],0,1)!="/"){
            $row['url'] = "/" . $row['url'];
        }


        if ($row['content_type']==60){
            $row['priority'] = 0.8;
        }else{
            $row['priority'] = 0.5;
        }
        $row['lastmod'] = date("Y-m-j",$row['mod_date']);
        if($row['url'] !="/" && $row['content_type']!=240 && $row['content_type']!=241 && $row['content_type']!=5500 && $row['url'] != "/index.php"){
           $row['url'] = htmlentities($row['url']);
            $data[] = $row;
        }
    }
}

XT::assign("DATA",$data);
$content = XT::build($style);

?>