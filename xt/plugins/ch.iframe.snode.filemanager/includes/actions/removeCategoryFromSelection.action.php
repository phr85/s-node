<?php
$selection = XT::getSessionValue('selection');
XT::setSessionValue('selection',str_replace(',' . XT::getValue('id'),'',$selection));
?>