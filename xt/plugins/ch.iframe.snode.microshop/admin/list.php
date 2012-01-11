<?php 
// hole alle displays und deren unterseiten
$current_display = XT::autoval('display_id',"R",0);

$data['display'] = XT::getQueryData(XT::query("SELECT * from " . XT::getTable("microshop_display") . " ORDER by title ASC",__FILE__,__LINE__),'id');

$res = XT::query("SELECT * from " . XT::getTable("microshop_pages") . " WHERE display_id={$current_display} ORDER by display_id ASC, position ASC",__FILE__,__LINE__);
while($row = $res->FetchRow()){
	$data['pages'][] = $row;
	switch ($row['type']) {
		case 0:
			// welche textseiten sollen noch geladen werden
			$textpages_to_load[] = $row['foreign_id'];
			break;
		case 1:
			// welche produktseiten sollen noch geladen werden
			$productpages_to_load[] = $row['foreign_id'];
			break;
	}
}
if(is_array($textpages_to_load)){
	// details holen für textseiten
	$res = XT::query("SELECT id, site_title from " . XT::getTable("microshop_textpage") . " WHERE id IN (" . implode(",", $textpages_to_load) . ")",__FILE__,__LINE__);
	while($row = $res->FetchRow()){
		$data['textpages_details'][$row['id']] = $row['site_title'];
	}
}
if(is_array($productpages_to_load)){
	// details holen für textseiten
	$res = XT::query("SELECT id, site_title from " . XT::getTable("microshop_productpage") . " WHERE id IN (" . implode(",", $productpages_to_load) . ")",__FILE__,__LINE__);
	while($row = $res->FetchRow()){
		$data['productpages_details'][$row['id']] = $row['site_title'];
	}
}
if(is_array($data['pages'])){
foreach ($data['pages'] as $key => $value) {
	switch ($value['type']){
		case 0:
			 $data['pages'][$key]['title'] = $data['textpages_details'][$value['foreign_id']];
			break;
		case 1:
			// welche produktseiten sollen noch geladen werden
			$data['pages'][$key]['title'] = $data['productpages_details'][$value['foreign_id']];
			break;
	}
}
}

$data['meta']['current_display'] = $current_display;
$data['meta']['current_page'] = $current_page;

XT::assign("LIST",$data);

$content = XT::build('list.tpl');

?>