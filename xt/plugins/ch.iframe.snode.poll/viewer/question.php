<?php

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

$id = XT::autoval("id","R");

$data = array();
    $result = XT::query("
        SELECT
            id,title,multiple,description,image,image_version,image_zoom
        FROM
            " . XT::getTable('poll') . "
        WHERE
        	id =  " . $id . "
        "
    	, __FILE__, __LINE__);
    
    while($row = $result->FetchRow()){		
        $data['id'] = $row['id']; 	
        $data['title'] = $row['title']; 
        $data['multiple'] = $row['multiple']; 
        $data['image'] = $row['image']; 
        $data['image_version'] = $row['image_version']; 
        $data['image_zoom'] = $row['image_zoom']; 
        $data['description'] = $row['description']; 
    }
    // Get answers
    $result = XT::query("
        SELECT
            *
        FROM
            " . XT::getTable('answers') . "
        WHERE
        	poll_id =  " . $id . "
        ORDER BY
        	position ASC
        "
    	, __FILE__, __LINE__);
    
    $data['answers'] = XT::getQueryData($result);
    $data['listtpl'] = XT::getParam('listtpl');
    
    
    XT::assign("xt" . XT::getBaseID() . "_viewer", $data);
$content = XT::build('question_' . $style);

?>