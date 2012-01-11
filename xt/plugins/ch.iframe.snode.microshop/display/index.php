<?php

$style = XT::getParam("style") == "" ? "default.tpl" : XT::getParam("style");
XT::loadClass('phpmailer/class.phpmailer.php');
/**
 * DISPLAY
 */
$display_id = XT::getParam("display_id") == "" ? 0 : XT::getParam("display_id");
$res = XT::query("SELECT * from " . XT::getTable("microshop_display") . " WHERE id={$display_id} AND active = 1",__FILE__,__LINE__);
while($row = $res->FetchRow()){
	$data['display'] = $row;
}
XT::assign("DISPLAY",$data['display']);

$data['formvalues']['products'] = XT::autoval("prod","R");
$data['formvalues']['address'] = XT::autoval("address","R");

if ($data['formvalues']['products']) {
	foreach ($data['formvalues']['products'] as $id => $value) {
		if (!is_numeric($value) && !empty($value)) {
			$errors[$id] = 'In diesem Feld sind nur Zahlen erlaubt.';
		}
	}
}
if ($data['formvalues']['address']) {
	foreach ($data['formvalues']['address'] as $id => $value) {
		if (empty($value)) {
			$address_errors[$id] = 'error';
		}
		if ($id == 'email') {
			if (!preg_match("/^[^@]*@[^@]*\.[^@]*$/", $value)) {
				$address_errors[$id] = 'error';
			} 
		}
	}
}

XT::assign("ERRORS",$errors);
XT::assign("ADDRESSERRORS",$address_errors);

XT::assign("FORMVALUES",$data['formvalues']);

/**
 * Get current page
 */

if (XT::getValue("submit")) {
	$current_page = XT::autoval("page","R",1);
	if (!is_array($errors)) {
		$current_page++;
	}
}
else {
	$current_page = XT::autoval("page","R",1);
}

XT::assign("CURRENTPAGE", $current_page);
$res = XT::query("SELECT * from " . XT::getTable("microshop_pages") . " WHERE display_id={$display_id} AND position={$current_page} AND active = 1",__FILE__,__LINE__);
while($row = $res->FetchRow()){
	$data['page'] = $row;
}
switch ($data['page']['type']) {
	case 0:
		include 'type0.php'; // Textpage
		break;
	case 1:
		include 'type1.php'; // Productpage
		break;
	case 2:
		include 'type2.php'; // Orderingpage
		break;
}
XT::assign("CONTENT",$data['content']);

/**
 * NAVIGATION
 */
$res = XT::query("SELECT * from " . XT::getTable("microshop_pages") . " WHERE display_id={$display_id} AND active = 1 ORDER by display_id ASC, position ASC",__FILE__,__LINE__);
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

$res = XT::query("SELECT position from " . XT::getTable("microshop_pages") . " WHERE display_id={$display_id} AND active = 1 AND type=2",__FILE__,__LINE__);
while($row = $res->FetchRow()){
	$data['pos'] = $row;
}
XT::assign("ORDERPOS",$data['pos']['position']);
XT::assign("NAV",array_slice($data['pages'], 0, $data['pos']['position']));
XT::assign("ENDNAV",array_slice($data['pages'], $data['pos']['position']));

$content = XT::build($style);