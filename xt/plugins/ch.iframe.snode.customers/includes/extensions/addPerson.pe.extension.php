<?php

if(XT::getPermission("addCustomer")){
    $GLOBALS['plugin']->contribute("persons_buttons", "Add person", "addPerson","user1_add.png","1","master");
}

$GLOBALS['plugin']->contribute("persons_buttons", "Add ddd", "addPersondd","user1_add.png","1","master");
$GLOBALS['plugin']->contribute("persons_buttons", "Add dddd", "addPersonddd","user1_add.png","1","master");
$GLOBALS['plugin']->contribute("persons_buttons", "Add aaaaa", "addPersondddd","user1_add.png","1","master");

?>
