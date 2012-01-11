<?php

// Get permissions
if($GLOBALS['plugin']->getValue("package") != ''){
    $GLOBALS['plugin']->setSessionValue("package",$GLOBALS['plugin']->getValue("package"));
}

$permissions = glob(PLUGIN_DIR . $GLOBALS['plugin']->getSessionValue("package") . "/includes/permissions/*.permission.php");

// 1-4 perms
$perms[2]['perm'] = 'Node Permissions';

if(is_array($permissions)){
    foreach($permissions as $key => $value){
        $file = basename($value);
        $file_parts = explode('.',$file);
        $perms[$file_parts[0]]['perm'] = $file_parts[1];
    }
}

if(is_numeric($GLOBALS['plugin']->getValue("user_id"))){
    $result = XT::query("
        SELECT
            perms
        FROM
            " . $GLOBALS['cfg']->get("database","prefix") . "node_perms
        WHERE
            base_id = " . $GLOBALS['plugin']->getSessionValue("base_id") . "
            AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
            AND principal_id = " . $GLOBALS['plugin']->getValue("user_id") . "
            AND node_id = " . $GLOBALS['plugin']->getSessionValue("node_id") . "
            AND principal_type = 1
        ",__FILE__,__LINE__);
}

if($result){
    $data = array();
    while($row = $result->FetchRow()){
        foreach($perms as $key => $value){
            $perms[$key]['rights'] = $GLOBALS['perm']->getPerm($row['perms'],$key);
        }
    }
    
    if($result->_numOfRows == 0){
        XT::assign("NOTSET", 1);
    }
    //XT::printArray($result);
}
// Lang
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

// Assign permissions
XT::assign("PERMS", $perms);

// Save Button
XT::addImageButton('[S]ave','s1SaveUserPermission','default','disk_blue.png','0','slave1','s');
XT::addImageButton('Save [a]ll languages','s1SaveUserPermissionAllLang','default','disk_blue.png','0','slave1','a');
XT::addImageButton('[U]nset','s1UnsetUserPermission','default','delete.png','0','slave1','u');

XT::assign("USER_ID", $GLOBALS['plugin']->getValue("user_id"));


// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "s1User.tpl";
}
$content = XT::build($style);
?>