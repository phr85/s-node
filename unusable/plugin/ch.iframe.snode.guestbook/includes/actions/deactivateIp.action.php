<?php
// Block IP
XT::query("UPDATE " . XT::getTable('guestbook') . " SET blockip = 1 WHERE ip='" . $GLOBALS['plugin']->getValue('ip') . "'",__FILE__,__LINE__);

$ablockid = array();
$ablockid = split(';',$GLOBALS['plugin']->getConfig('ipblockinglist'));

if(!in_array(trim($GLOBALS['plugin']->getValue('ip')),$ablockid)){
    array_push($ablockid,$GLOBALS['plugin']->getValue('ip'));
    sort($ablockid);

    foreach($ablockid as $key=>$value){
        if($value != ''){
            $ipblocklist = $ipblocklist . ";" . trim($value);
        }
    }

    // Update config_settings File
    $configdata['ipblockinglist'] = substr($ipblocklist,1);
    $configdata['ipblocking'] = 1;
    $GLOBALS['cfg']->changeValuesConfigFile($GLOBALS['plugin']->location . '../', $GLOBALS['plugin']->getConfigs(), $configdata);
}

header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['tpl_id']);
?>