<?php
/**
 * The template function xt allows you to call various methods form the xt class.
 * @param string function Method or function of the xt class like XT::xyz...
 * @param string/array parameter Parameter for the methode as array or comma seperated string
 * @param string assign Name of a template variable which is used to store the result
 * @param bool return Return the result if this parameter is true
 * @return mixed Returns the return value of a xt methode if the parameter return is true
 *
 * example:
 * {xt function="getUserID" assign="myUserName"}
 * This function calls the mehtode XT::getUserID() which returns the current user id.
 * The assign parameter assigns that return value to the template variable myUserName.
 * In this case the parameter "return" isn't set, therefore it's false and our
 * function don't return the returned value.
 */
$tpl->register_function("xt","getxt");
function getxt($params){
    if ($params['function'] != ""){
    	$method = $params['function'];
    	$parameter = $params['parameter'];
    	if (!is_array($parameter)){
    		$parameter = explode(",",$parameter);
    	}
    	$xt = new XT;
    	$result =  call_user_func_array(array($xt, $method),$parameter);
    }

    if ($params['assign'] != "") {
    	XT::assign($params['assign'] ,$result);
    }
    if ($params['return'] == true) {
    	return $result;
    }
}
?>