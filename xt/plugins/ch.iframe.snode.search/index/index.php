<?php

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Get all pages
$result = XT::query("
    SELECT
        a.title,
        a.content_id,
        b.open_url,
        a.ext_link
    FROM
        " . XT::getTable('search_infos_global') . " as a LEFT JOIN
        " . XT::getDatabasePrefix() . "content_types as b ON (b.id = a.content_type)
    WHERE
        a.public = 1 AND
        a.active = 1 AND
        a.title != ''
    GROUP BY
        a.title
    ORDER BY
        a.title ASC
",__FILE__,__LINE__);

$entries = array();
while($row = $result->FetchRow()){
    
    if($row['ext_link'] == NULL){
        $row['url'] = str_replace('%id%',$row['content_id'],$row['open_url']);
    }else{
        $row['url'] = $row['ext_link'];
    }
                
    $done = false;
    $letter = strtoupper(substr($row['title'],0,1));
    if(is_numeric($letter)){
        $entries["0-9"][] = $row;
    } else {
        if($letter == '�'){
            $entries['U'][] = $row;
            $done = true;
        }
        if($letter == '�'){
            $entries['A'][] = $row;
            $done = true;
        }
        if($letter == '�'){
            $entries['O'][] = $row;
            $done = true;
        }
        if(!$done){
            $entries[$letter][] = $row;
        }
    }
}

XT::assign("ENTRIES",$entries);

$content = XT::build($style);
?>