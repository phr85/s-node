<?php

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Get users
$result = XT::query("
    SELECT
        a.username,
        a.firstName,
        a.lastName
    FROM
        " . XT::getTable('user') . " as a
    WHERE
        a.active = 1 AND
        a.username != ''
    ORDER BY
        a.username ASC
",__FILE__,__LINE__);

$entries = array();
while($row = $result->FetchRow()){
                
    $done = false;
    $letter = strtoupper(substr($row['username'],0,1));
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