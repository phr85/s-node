<?php

// Blacklist (IP)
if(XT::getConfig('enable_blacklist_ip')){
    if(in_array($_SERVER['REMOTE_ADDR'], XT::getConfig('blacklist_ip'))){
        die("You're IP is blocked");
    }
}

// Allowed (IP)
if(XT::getConfig('enable_allowed_ip')){
    if(!in_array($_SERVER['REMOTE_ADDR'], XT::getConfig('allowed_ip'))){
        die("You're IP is not allowed to view this site");
    }
}

// Day check
if(XT::getConfig('enable_time_range')){
    if(!in_array(date('w'), XT::getConfig('time_range_weekdays'))){
        die("Site is currently down");
    }
    
    if(!in_array(intval(date('H')), XT::getConfig('time_range_hours'))){
        die("Site is currently down");
    }
}

// Country check
if(XT::getConfig('enable_country')){
    if(!in_array($_SESSION['COUNTRY'], XT::getConfig('allowed_countries'))){
        die("Site is not available in your country");
    }
}

?>