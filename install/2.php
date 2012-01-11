<?php

// Check DB Connection
include(CLASS_DIR . 'db/adodb/adodb.inc.php');

if($_POST['db_host']){
    $_SESSION['config']['database']['host'] = $_POST['db_host']; 
}
if($_POST['db_username']){
    $_SESSION['config']['database']['username'] = $_POST['db_username']; 
}
if($_POST['db_password']){
    $_SESSION['config']['database']['password'] = $_POST['db_password']; 
} else {
    $_SESSION['config']['database']['password'] = '';
}

$db = &ADONewConnection('mysql');
$ADODB_COUNTRECS = false;
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
if(@$db->Connect($_SESSION['config']['database']['host'], $_SESSION['config']['database']['username'], $_SESSION['config']['database']['password'])){
    $tpl->assign('DATABASES',$db->MetaDatabases());
    $tpl->assign('CONNECTED', true);
    $_SESSION['config']['database']['connected'] = true;
} else {
    $tpl->assign('CONNECTED', false);
    $_SESSION['config']['database']['connected'] = false;
}

$tpl->display('2.tpl');

?>