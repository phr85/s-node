<?php

// Typ ermitteln
$TYP = XT::getQueryData(XT::query("SELECT * from " . XT::getTable('microshop_pages') . " WHERE id=" . XT::autoval("page_id") ,__FILE__,__LINE__));

// Typenseite ermitteln
if($TYP[0]['type']==0){
	// textseite löschen
	XT::query("DELETE from " . XT::getTable('microshop_textpage') . " WHERE id=" . $TYP[0]['foreign_id'],__FILE__,__LINE__);
}
if($TYP[0]['type']==1){
	// textseite löschen
	XT::query("DELETE from " . XT::getTable('microshop_productpage') . " WHERE id=" . $TYP[0]['foreign_id'],__FILE__,__LINE__);
	// ev. Produkte löschen
	XT::query("DELETE from " . XT::getTable('microshop_products') . " WHERE product_page_id=" . $TYP[0]['foreign_id'],__FILE__,__LINE__);
}


// page selbst löschen
XT::query("DELETE from " . XT::getTable('microshop_pages') . " WHERE id=" . $TYP[0]['id'],__FILE__,__LINE__);

// posititonen neu rechnen
$res = (XT::query("SELECT * from " . XT::getTable('microshop_pages') . " WHERE display_id=" . XT::autoval("display_id","S") . " order by position ASC",__FILE__,__LINE__));
$i = 1;
while ($row = $res->fetchRow()){
	// saubere sortierung machen
	XT::query("UPDATE " . XT::getTable('microshop_pages') . " set position=" . $i . " WHERE id = " . $row['id'] ,__FILE__,__LINE__);
	$i++;
}

?>