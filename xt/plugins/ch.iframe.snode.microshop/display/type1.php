<?php

/**
 * Type 1 - Productpages
 */
$res = XT::query("SELECT * from " . XT::getTable("microshop_productpage") . " WHERE display_id={$display_id} AND id={$data['page']['foreign_id']}",__FILE__,__LINE__);
while($row = $res->FetchRow()){
	$data['content'] = $row;
}
$data['content']['style'] =  'ch.iframe.snode.microshop/display/type' . $data['page']['type'] . '/' . $data['content']['style'];

$res = XT::query("SELECT * FROM " . XT::getTable("microshop_productpage") . " AS pp INNER JOIN " . XT::getTable("microshop_products") . " AS p ON p.product_page_id = pp.id WHERE p.active = 1",__FILE__,__LINE__);
while($row = $res->FetchRow()){
	$data['products'][] = $row;
}
XT::assign("PRODUCTS",$data['products']);