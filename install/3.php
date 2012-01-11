<?php

if($_POST['db_database'] != ''){
    $_SESSION['config']['database']['database'] = $_POST['db_database']; 
}
if($_POST['db_prefix'] != ''){
    $_SESSION['config']['database']['prefix'] = $_POST['db_prefix']; 
}

// Get license number
$files = glob('xt/licenses/*.zl');
$licensename_parts = explode('_',basename($files[0]));
$license_number = $licensename_parts[0];
$tpl->assign('LICENSENUMBER',$license_number);
$tpl->assign('WEBROOT_DIR',substr($_SERVER['PHP_SELF'],0,-11));

$tpl->display('3.tpl');

?>