<?php
if(XT::getValue("use_date")!=0){
    XT::setSessionValue("date",XT::getValue("use_date"));
    XT::assign("NEWDATE",XT::getValue("use_date"));
}

?>