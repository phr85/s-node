<?PHP

$data = array();

$data['billing_address'] = XT::getSessionValue('billing_address');
$data['shipping_address'] = XT::getSessionValue('shipping_address');

if($GLOBALS['plugin']->getValue('action') !=""){
    include($GLOBALS['plugin']->getValue('action') . ".action.php");
}

if($GLOBALS['auth']->isAuth()){
    
    // Adresse holen und assignen
    $sql = "SELECT * FROM " . XT::getTable('customers') . " WHERE active = 1 AND user_id =" . $_SESSION['user']['id'];
    $result = XT::query($sql,__FILE__,__LINE__,0);
    
    $address = XT::getQueryData($result);
	$data['addresses']  = $address;
	$data['username']  = $_SESSION['user']['name'];
}

// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
XT::assign('xt' . XT::getBaseId() . '_addressdata',$data);   
$content = XT::build($style);

?>