<?php
    // get remote IP
    $data['ip'] = XT::getValue("ipstring");

    $ip = explode(".",XT::getValue("ipstring"));
    // calculate number (www.maxmind.com)
    $ipnum = 16777216*$ip[0] + 65536*$ip[1] + 256*$ip[2] + $ip[3];
    $result = XT::query("SELECT country FROM " . XT::getTable('geo') . " WHERE " . $ipnum . " BETWEEN begin_num AND end_num",__FILE__,__LINE__);

    $data['query'] = "SELECT country FROM " . XT::getTable('geo') . " WHERE " . $ipnum . " BETWEEN begin_num AND end_num";
    $data['country'] = XT::getQueryData($result);
    XT::assign("DATA",$data);

// Build plugin
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';
$content = XT::build($style);
?>
