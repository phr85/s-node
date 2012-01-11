<?php
if(XT::getValue('country')!=""){
XT::setSessionValue('country',XT::getValue('country'));
}

$result = XT::query("
    SELECT c.*
    FROM
        " . XT::getTable('events') . " as event 
    INNER JOIN
        " . XT::getTable('events_details') . " as event_det ON(event.id = event_det.id and event_det.lang='" . XT::getLang() . "')
    INNER JOIN
        " . XT::getTable('countries') . " as c ON (c.country = event.country)
    WHERE
    	event_det.active = 1
    GROUP by c.country
   
    ORDER BY
        c.name ASC
    ",__FILE__,__LINE__,0);
                    

XT::assign("DATA", XT::getQueryData($result));

XT::assign("SELECTED",XT::getSessionValue('country'));

// Build plugin
$content = XT::build('default.tpl');
?>