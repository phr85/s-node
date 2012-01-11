<?php

// seite produkt hinzufuegen
XT::query("INSERT into " . XT::getTable("microshop_productpage") . " set site_title='NEW Product', display_id=" .  XT::getValue("display_id"),__FILE__,__LINE__);
$prodid = XT::getQueryData(XT::query("SELECT id from " . XT::getTable("microshop_productpage") . " WHERE display_id=" .  XT::getValue("display_id") . " ORDER by id desc limit 0,1",__FILE__,__LINE__));
// page  registrieren an letzter position
XT::query("INSERT into " . XT::getTable('microshop_pages') . " set type=1, display_id=" . XT::getValue("display_id") . ", position=9999, active=1, locked=0, foreign_id=" . $prodid[0]['id'],__FILE__,__LINE__);


$res = (XT::query("SELECT * from " . XT::getTable('microshop_pages') . " WHERE display_id=" . XT::autoval("display_id") . " order by position ASC",__FILE__,__LINE__));
$i = 1;
while ($row = $res->fetchRow()){
	// saubere sortierung machen
	XT::query("UPDATE " . XT::getTable('microshop_pages') . " set position=" . $i . " WHERE id = " . $row['id'] ,__FILE__,__LINE__);
	$i++;
}

?>