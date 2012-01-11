<?php

if(is_numeric(XT::getValue("id"))){
    XT::setSessionValue("fieldgroup_id",XT::getValue('id'));    
}else {
    XT::setSessionValue("fieldgroup_id",XT::getValue("fieldgroup_id"));
}

XT::setAdminModule("ge");
?>
