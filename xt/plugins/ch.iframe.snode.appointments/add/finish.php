<?php

// Parameter :: style
$style = XT::getParam("style") != '' ? XT::getParam("style") : 'default.tpl';
$style = str_replace(".tpl","",$style);

$inputvalues = XT::autoVal('inputvalues',"S");

$userdata = XT::autoVal('userdata',"S");

$selecteddates = array();

$i = 0;
foreach ($userdata as $key => $value) {
	$temp[$i] = explode("_",$key);
	$selecteddates[$i] = $temp[$i][0];
	$times[$key] = $value;
	$i++;
}

$selecteddates = array_unique($selecteddates);

$data = array();
$data['viewerTpl'] = XT::getParam("viewer_tpl");
$data['values'] = $inputvalues;
$data['selecteddates'] = $selecteddates;

XT::assign("xt" . XT::getBaseID() . "_add", $data);

$content = XT::build($style."/finish.tpl");

?>