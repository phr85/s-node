<?php

// Param :: Style
$style = XT::getParam("style") != "" ? XT::getParam("style") : "default.tpl";

// mail checken
if(!XT::checkEmail(trim(XT::getValue('email')))){
    //The e-mail was not valid
    $validmail = false;
}else{
    //The e-mail was valid
    $validmail = true;
}

// Eintragungen f�r gesetzte Filter machen
$nodefilter = XT::getSessionValue('nodefilter');
// Kategorie ermitteln
if($nodefilter[0] > 0){
    $result = XT::query("
        SELECT 
            tn.title
        FROM
            " . $GLOBALS['plugin']->getTable('nodes') . " as tn
        WHERE 
            tn.node_id=" . $nodefilter[0]
        ,__FILE__, __LINE__);
        
    $row = $result->fetchRow();
    XT::assign('KATEGORY', $row['title']);
    
}

$filter = XT::getSessionValue('filter');

if($validmail){
    // Bestehende Emailadresse l�schen
    XT::query("DELETE from " . XT::getTable('suchabo') . " WHERE email = '" . trim(XT::getValue('email')) . "'",__FILE__,__LINE__);


    XT::query("Insert into " . XT::getTable('suchabo') . "(
    `id`, 
    `email`, 
    `valid_to`, 
    `filter_kategorie`, 
    `filter_ort`, 
    `filter_zimmer`, 
    `filter_kauf`, 
    `create_date`, 
    `last_search_date`, 
    `last_search_id`,
    `lang`
     ) values ( 
     NULL,  
     '" . trim(XT::getValue('email')) . "',  
     '" . (time() + (XT::getValue('dauer') * 2678400)) . "',  
     '" . $nodefilter[0] . "',  
     '" . $filter[1] . "',  
     '" . $filter[7] . "',  
     '" . $filter[3] . "',  
     '" . time() . "',  
     0,  
     0,
     '" . $GLOBALS['lang']->getLang() . "'
     )",__FILE__,__LINE__);
}

XT::assign('DURATION',XT::getValue('dauer'));
XT::assign('VALIDMAIL',$validmail);
XT::assign('FILTER',$filter);
XT::assign('NODEFILTER',$nodefilter);
XT::assign('EMAIL',trim(XT::getValue('email')));
$content = XT::build($style);
?>