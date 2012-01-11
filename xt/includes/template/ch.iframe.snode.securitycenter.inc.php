<?php


$tpl->register_function("xt_isInRole","xt_isInRole");
function xt_isInRole($params){
    $roles = XT::getRoles();
    if(in_array($params['value'],$roles)){
        XT::assign($params['assign'],true);
    }else {
        XT::assign($params['assign'],false);
    }
}

$tpl->register_modifier("xt_getUserProperties","xt_getUserProperties");
/**
 * Smarty modifier to return the email
 * @param  string value The id of the user
 * @return string the email
 * Example: {$DATA.user_id|xt_getUserProperties:"email"}
 */
function xt_getUserProperties($value,$param,$assign=null){
    if(!$assign){
    return XT::getUserProperties($param,$value);
    }else{
        XT::assign($assign,XT::getUserProperties($param,$value));
    }
}

?>