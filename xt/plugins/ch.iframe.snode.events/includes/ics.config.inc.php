<?php

// this month
$calendar_time_range["this_month"]["from"] = mktime(0,0,0, date("n"), 1, date("Y"));
$calendar_time_range["this_month"]["to"] = mktime(0,0,0, date("n")+1, 1, date("Y"))-1;

// this year
$calendar_time_range["this_year"]["from"] = mktime(0,0,0, 1, 1, date("Y"));
$calendar_time_range["this_year"]["to"] = mktime(0,0,0, 1, 1, date("Y")+1)-1;

?>