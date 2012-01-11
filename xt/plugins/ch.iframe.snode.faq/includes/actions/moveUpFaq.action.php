<?php
// sortierung sicherstellen
$sortieren = XT::getQueryData(XT::query("SELECT faq_id, node_id from " . XT::getTable('faq2cat') . "  order by position asc"));
$sortierposition = 1;
foreach ($sortieren as $feld) {
	   XT::query("
            UPDATE 
               " . XT::getTable('faq2cat') . "
            SET 
                position = {$sortierposition}
            WHERE 
                node_id = {$feld['node_id']} AND 
                faq_id =  {$feld['faq_id']}"
            ,__FILE__,__LINE__);
            $sortierposition++;
}


    // aktuelle position ermitteln
    $position = XT::getQueryData(XT::query("SELECT position from " . XT::getTable('faq2cat') . " 
    WHERE node_id = " . XT::getValue("node_id") . " AND 
                faq_id = " . XT::getValue("id") . "
                ",__FILE__,__LINE__));
    
    if($position[0]['position'] > 1 ){
	    // element mit kleinerer position auf aktuelle position setzen wenn nicht 0
			    
        XT::query("
            UPDATE 
               " . XT::getTable('faq2cat') . "
            SET 
                position = {$position[0]['position']}
            WHERE 
                node_id = " . XT::getValue("node_id") . " AND 
                position = " . ( $position[0]['position'] -1 ) 
            ,__FILE__,__LINE__);
	    
	    
	    // elementposition auf position -1 setzen wenn nicht 0
	
        XT::query("
            UPDATE 
               " . XT::getTable('faq2cat') . "
            SET 
                position = " . ( $position[0]['position'] -1 ) . "
            WHERE 
                node_id = " . XT::getValue("node_id") . " AND 
                faq_id =  " . XT::getValue("id") 
            ,__FILE__,__LINE__);
    }    
?>