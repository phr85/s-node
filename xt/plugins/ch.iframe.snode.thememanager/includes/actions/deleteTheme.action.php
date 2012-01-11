<?php

rmdirr(TEMPLATE_DIR . XT::getValue('theme_title'));
rmdirr(BASE_DIR . '/styles/live/' . XT::getValue('theme_title'));
rmdirr(BASE_DIR . "/images/" . XT::getValue('theme_title'));
rmdirr(BASE_DIR . "/fonts/" . XT::getValue('theme_title'));
rmdirr(BASE_DIR . "/scripts/" . XT::getValue('theme_title'));

function rmdirr($dir) {
   if($objs = glob($dir . "/*")){
       foreach($objs as $obj) {
           is_dir($obj)? rmdirr($obj) : unlink($obj);
       }
   }
   @rmdir($dir);
}

?>