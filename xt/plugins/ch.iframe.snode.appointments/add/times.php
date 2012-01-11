<?php

// Parameter :: style
$style = XT::getParam("style") != '' ? XT::getParam("style") : 'default.tpl';
$style = str_replace(".tpl","",$style);


$inputvalues = XT::getSessionValue('inputvalues');

print_r($inputvalues);

$dates = $inputvalues['date'];

XT::assign("xt" . XT::getBaseID() . "_dates", $dates);
XT::assign("xt" . XT::getBaseID() . "_values", $inputvalues);

XT::setSessionValue('dates',$dates);

$content = XT::build($style."/times.tpl");

?>