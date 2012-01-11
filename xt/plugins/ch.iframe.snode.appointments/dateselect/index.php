<?php 

$data = explode(",",XT::getValue('datearray'));

sort($data);

$i = 0;
foreach ($data as $value){
		$data[$i] = substr($data[$i],0,-3);
		$i ++;
}

XT::assign("xt" . XT::getBaseID() . "_dateselect", $data);

XT::setSessionValue("datearray", $data);

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';
$content = XT::build($style);

?>