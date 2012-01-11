<?php
$move = XT::getQueryData(XT::query("SELECT * from " . XT::getTable('microshop_pages') . " WHERE id=" . XT::getValue('page_id') ,__FILE__,__LINE__));
XT::query("UPDATE " . XT::getTable('microshop_pages') . " set position=position+1 WHERE display_id = " . XT::autoval("display_id","S") . " and position < " . $move[0]['position'] . " order by position desc Limit 1",__FILE__,__LINE__);
XT::query("UPDATE " . XT::getTable('microshop_pages') . " set position=position-1 WHERE id = " . $move[0]['id'] . " Limit 1");
$res = (XT::query("SELECT * from " . XT::getTable('microshop_pages') . " WHERE display_id=" . XT::autoval("display_id","S") . " order by position ASC",__FILE__,__LINE__));
$i = 1;
while ($row = $res->fetchRow()){
	// saubere sortierung machen
	XT::query("UPDATE " . XT::getTable('microshop_pages') . " set position=" . $i . " WHERE id = " . $row['id'] ,__FILE__,__LINE__);
	$i++;
}

?>