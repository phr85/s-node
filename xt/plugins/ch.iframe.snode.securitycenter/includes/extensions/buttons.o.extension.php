<?php

if($GLOBALS['plugin']->getSessionValue("ctrl_add") == 0 && $GLOBALS['plugin']->getSessionValue('ctrl_cut') == 0 && $GLOBALS['plugin']->getSessionValue('ctrl_copy') == 0){
    switch ($GLOBALS['plugin']->getValue("principal_type")) {
        case 4: //pool
        $GLOBALS['plugin']->contribute("buttons_o", "add <u>r</u>oles", "addRole","role.png","0","slave1","r");
        $GLOBALS['plugin']->contribute("buttons_o", "add <u>g</u>roups", "addGroup","group.png","0","slave1","g");
        $GLOBALS['plugin']->contribute("buttons_o", "add <u>u</u>sers", "addUser","user1.png","0","slave1","u");
        break;
        case 3: //role
        if($GLOBALS['plugin']->getValue("group_selected")==1){
            $GLOBALS['plugin']->contribute("buttons_o", "add <u>u</u>sers to group", "addUser2Group","user1.png","0","slave1","u");
        }else{
            $GLOBALS['plugin']->contribute("buttons_o", "add <u>g</u>roups to role", "addGroup2Role","group.png","0","slave1","g");
            $GLOBALS['plugin']->contribute("buttons_o", "add <u>u</u>sers to role", "addUser2Role","user1.png","0","slave1","u");
        }
        break;
        case 2 : //group
        $GLOBALS['plugin']->contribute("buttons_o", "add <u>u</u>sers to group", "addUser2Group","user1.png","0","slave1","u");
        break;

        default:
        $GLOBALS['plugin']->contribute("buttons_o", "create <u>p</u>ool", "addPool","data_add.png","1","master","p");
        break;
    }

}else{
    $GLOBALS['plugin']->contribute("buttons_o", "<u>c</u>ancel", "cancelAddPool","delete.png","1","master","u");
}
?>