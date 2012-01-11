<?php

$error = false;

// PHP Support
if(PHP_VERSION >= 4.3){
    $tpl->assign("PHP", true);
} else {
    $error = true;
    $tpl->assign("PHP", false); 
}
$tpl->assign("PHP_VERSION", PHP_VERSION);

// MySQL Support
if(function_exists('mysql_connect')){
    $tpl->assign("MYSQL", true);
} else {
    $error = true;
    $tpl->assign("MYSQL", false); 
}

// GD Support
if(gdVersion() >= 2){
    $tpl->assign("GD", true);
} else {
    $error = true;
    $tpl->assign("GD", false);
}
$tpl->assign("GD_VERSION", gdVersion());

// Is writeable
if(is_writable('xt') && is_writable('index.php')){
    $tpl->assign("CHMOD", true);
} else {
    $error = true;
    $tpl->assign("CHMOD", false);
}

// Zend Optimizer installed ?
if(function_exists('zend_loader_file_licensed')){
    $tpl->assign("OPTIMIZER", true);
} else {
    $error = true;
    $tpl->assign("OPTIMIZER", false);
}

$tpl->assign("ERROR", $error);

$tpl->display('1a.tpl');

function gdVersion($user_ver = 0){
   if (! extension_loaded('gd')) { return; }
   static $gd_ver = 0;
   // Just accept the specified setting if it's 1.
   if ($user_ver == 1) { $gd_ver = 1; return 1; }
   // Use the static variable if function was called previously.
   if ($user_ver !=2 && $gd_ver > 0 ) { return $gd_ver; }
   // Use the gd_info() function if possible.
   if (function_exists('gd_info')) {
   	   $match = array();
       $ver_info = gd_info();
       preg_match('/\d/', $ver_info['GD Version'], $match);
       $gd_ver = $match[0];
       return $match[0];
   }
   // If phpinfo() is disabled use a specified / fail-safe choice...
   if (preg_match('/phpinfo/', ini_get('disable_functions'))) {
       if ($user_ver == 2) {
           $gd_ver = 2;
           return 2;
       } else {
           $gd_ver = 1;
           return 1;
       }
   }
   // ...otherwise use phpinfo().
   ob_start();
   phpinfo(8);
   $info = ob_get_contents();
   ob_end_clean();
   $info = stristr($info, 'gd version');
   preg_match('/\d/', $info, $match);
   $gd_ver = $match[0];
   return $match[0];
}
// End gdVersion()

?>