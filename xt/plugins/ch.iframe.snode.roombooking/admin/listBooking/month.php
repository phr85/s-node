<?php

$daterange=getDateRange(XT::getSessionValue("date"),"month");
// Get all bookings from room
$result = XT::query("
    SELECT usr.username, 
           usr.firstName,
           usr.lastName,
           usr.street,
           usr.plz,
           usr.city,
           usr.email,
           usr.tel,
           usr.facsimile,
           usr.lang,
           usr.description,
           usr.image,
           usr.image_version,
           room.title as room,
           book.* FROM
        " . $GLOBALS['plugin']->getTable("bookings") . " as book
    LEFT JOIN 
        " . XT::gettable("user") . " as usr on(book.creation_user = usr.id)
    LEFT JOIN 
        " . XT::gettable("rbs_rooms") . " as room on(book.room_id = room.id)
    WHERE
        book.room_id = " . $GLOBALS['plugin']->getSessionValue("room_id") . "
    AND
        book.date_from >= " . $daterange[0] . "
    AND
        book.date_to <= " . $daterange[1] . "
        ORDER by book.date_from asc"      
,__FILE__,__LINE__);

while($row = $result->FetchRow()){
    $bookings[date("j",$row['date_from'])][]=$row;
}

XT::assign("BOOKINGS", $bookings);


$year =  XT::getValue("date") == "" ? date("Y", XT::getSessionValue("date")) : date("Y", XT::getValue("date"));
$month = XT::getValue("date") == "" ? date("m", XT::getSessionValue("date")) : date("m", XT::getValue("date"));
$sday =  XT::getValue("date") == "" ? date("j", XT::getSessionValue("date")) : date("j", XT::getValue("date"));
$makedtime = mktime(0,0,0, $month, 1, $year);
$days_in_month = date("t", $makedtime);
$day_start = date("w", $makedtime)-1;
if ($day_start==-1){
    $day_start=6;
}
$days = array();
$rows = 0;
$day = 1;

// create rows
while ($rows < 6) {
    $cols = 0;
    $days[$rows] = array();
    // create cols
    for ($i = 0; $i < 7; $i++) {
        // skip day start
        if ($i < $day_start && $skip_start == false) {
            $days[$rows][$i] = '';
        } else {
            $skip_start = true;
            if($day < ($days_in_month + 1)) {
                $days[$rows][$i] = $day++;
            } else {
                $days[$rows][$i] = '';
            }
        }
    }
    $rows++;
}
$sday =  XT::getValue("date") == "" ? date("j", XT::getSessionValue("date")) : date("j", XT::getValue("date"));
XT::assign("SELECTED_DAY", $sday);
XT::assign("DAYS", $days);

XT::assign("COUNTS", $bookingcount);
XT::assign("DATERANGE",$daterange);
$content = XT::build("listBooking/month.tpl");
?>