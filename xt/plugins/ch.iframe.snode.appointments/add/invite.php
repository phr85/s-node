<?php

// Parameter :: style
$style = XT::getParam("style") != '' ? XT::getParam("style") : 'default.tpl';
$style = str_replace(".tpl","",$style);

XT::assign("xt" . XT::getBaseID() . "_inputvalues", Xt::getSessionValue('inputvalues'));

$content = XT::build($style."/invite.tpl");

?>