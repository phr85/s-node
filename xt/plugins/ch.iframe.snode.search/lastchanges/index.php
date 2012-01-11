<?php

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Get all pages
$result = XT::query("
    SELECT
        a.title,
        a.content_id,
        a.content_type,
        b.open_url,
        a.ext_link,
        u.username,
        a.mod_date,
        b.title as content_type_title
    FROM
        " . XT::getTable('search_infos_global') . " as a LEFT JOIN
        " . XT::getDatabasePrefix() . "content_types as b ON (b.id = a.content_type) LEFT JOIN
        " . XT::getDatabasePrefix() . "user as u ON (u.id = a.mod_user)
    WHERE
        a.public = 1 AND
        a.active = 1 AND
        a.title != ''
    ORDER BY
        a.mod_date DESC
    LIMIT 50
",__FILE__,__LINE__);

$entries = array();
while($row = $result->FetchRow()){
    
    if($row['ext_link'] == NULL){
        $row['url'] = str_replace('%id%',$row['content_id'],$row['open_url']);
    }else{
        $row['url'] = $row['ext_link'];
    }
             
    if(date('d.m.Y',$row['mod_date']) == date('d.m.Y')){   
        $entries[$GLOBALS['lang']->msg('Today')][] = $row;
    } else {
        $entries[date('d.m.Y',$row['mod_date'])][] = $row;    
    }
}

XT::assign("ENTRIES",$entries);

$content = XT::build($style);

?>