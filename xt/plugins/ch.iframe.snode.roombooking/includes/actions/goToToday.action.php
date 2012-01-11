<?php
   $i = getDateRange(TIME,"day");
    XT::setSessionValue("date",$i[0] +1);
    XT::assign("NEWDATE",$i[0]);
?>