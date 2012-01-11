<?php

if(XT::getPermission("addCustomer")){
    $GLOBALS['plugin']->contribute("buttons", "Add company", "addCustomer","add.png","1","master");
}

?>
