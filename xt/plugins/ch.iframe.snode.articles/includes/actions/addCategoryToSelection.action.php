<?php
if(XT::getSessionValue('selection')==","){
    XT::setSessionValue('selection',"0,");
}
if(!strchr(XT::getSessionValue('selection'),',' . XT::getValue('id'))){
    XT::setSessionValue('selection',XT::getSessionValue('selection') . XT::getValue('id') .',');
}
?>