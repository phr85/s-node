<?php

// Set base id
XT::setBaseID(4400);

// Activate checks
XT::addConfig('enable_blacklist_ip',true);
XT::addConfig('enable_allowed_ip',true);
XT::addConfig('enable_time_range',true);
XT::addConfig('enable_country',true);

// Blacklist (IP)
XT::addConfig('blacklist_ip',array(
    '0.0.0.0',
));

// Allowed (IP)
XT::addConfig('allowed_ip',array(
    '127.0.0.1',
));

// Time range
XT::addConfig('time_range_weekdays',array(0,1,2,3,4,5,6)); // 0 = Sunday, 6 = Saturday
XT::addConfig('time_range_hours',array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24));

// Country
XT::addConfig('allowed_countries',array(
    'CH',
    'DE',
    'AT',
    'US',
));

?>