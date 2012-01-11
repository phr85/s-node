<?php
if($_REQUEST['setze_land']!=""){
    $_SESSION['COUNTRY'] = strtoupper($_REQUEST['setze_land']);
    XT::assign_permanent('COUNTRY', strtolower($_SESSION['COUNTRY']));
}

if(!isset($_SESSION['COUNTRY'])){
    // get remote IP
    $ip = explode('.',$_SERVER['REMOTE_ADDR']);
    // get submitted ip if is setted
    if($GLOBALS['plugin']->getParam("ip") !=""){
        $ip = explode('.',$GLOBALS['plugin']->getParam("ip"));
    }
    // calculate number (www.maxmind.com)
    $ipnum = 16777216*$ip[0] + 65536*$ip[1] + 256*$ip[2] + $ip[3];
    $result = XT::query("SELECT country FROM " . XT::getTable('geo') . " WHERE " . $ipnum . " BETWEEN begin_num AND end_num",__FILE__,__LINE__);
    $country = XT::getQueryData($result);
    $_SESSION['COUNTRY'] = $country[0]['country'];
    XT::assign_permanent('COUNTRY', strtolower($_SESSION['COUNTRY']));
}
?>