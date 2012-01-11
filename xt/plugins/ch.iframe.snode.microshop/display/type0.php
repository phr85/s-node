<?php

/**
 * Type 0 - Textpages
 */
$res = XT::query("SELECT * from " . XT::getTable("microshop_textpage") . " WHERE display_id={$display_id} AND id={$data['page']['foreign_id']}",__FILE__,__LINE__);
while($row = $res->FetchRow()){
	$data['content'] = $row;
}
$data['content']['style'] =  'ch.iframe.snode.microshop/display/type' . $data['page']['type'] . '/' . $data['content']['style'];