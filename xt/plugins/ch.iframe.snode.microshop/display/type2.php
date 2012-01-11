<?php

/**
 * Type 2 - Orderpage
 */

/**
 * Generate style
 */
$data['content']['style'] =  'ch.iframe.snode.microshop/display/type' . $data['page']['type'] . '/default.tpl';

$res = XT::query("SELECT * FROM " . XT::getTable("microshop_productpage") . " AS pp INNER JOIN " . XT::getTable("microshop_products") . " AS p ON p.product_page_id = pp.id WHERE p.active = 1",__FILE__,__LINE__);
while($row = $res->FetchRow()){
	$data['products'][] = $row;
}

foreach ($data['products'] as $id => $product) {
		$data['products'][$id]['freeproducts'] = (floor($data['formvalues']['products'][$id + 1] / $product['give_gift_by']) * $product['receive_items']);
}
XT::assign("PRODUCTS",$data['products']);

foreach ($data['formvalues']['products'] as $id => $amount) {
		$sum = $sum + $amount * $data['products'][$id - 1]['price'];
}
XT::assign("SUM",$sum);

foreach ($data['products'] as $id => $product) {
		$product_sum[$id+1] = floor($data['formvalues']['products'][$id + 1] * $product['price']);
}
XT::assign("PRODUCTSUM",$product_sum);

if (XT::getValue("send")) {
	$current_page = XT::autoval("page","R",1);
	if (!is_array($address_errors)) {
		// Mail versenden
	    $mail = new PHPMailer();
	    $mail->IsSMTP();
	    $mail->IsHTML(true);
	    $mail->Encoding = '7bit';
	    $mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
	    $mail->FromName = $data['display']['op_title'];
	    $mail->From = $data['display']['pm_email'];
	    $mail->Host = $GLOBALS['cfg']->get('smtp','Host');
	    $mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
	    if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
	        $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
	        $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
	    }
	    $mail->AddAddress(trim($data['formvalues']['address']['email']));
	    $mail->Subject  = "Vielen Dank für Ihre Bestellung bei " . $data['display']['op_title'];
	    $mail->Body  = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'mail/default.tpl');
	    if(!$mail->Send()){
	        XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
	    }
	    
	    $mail = new PHPMailer();
	    $mail->IsSMTP();
	    $mail->IsHTML(true);
	    $mail->Encoding = '7bit';
	    $mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
	    $mail->FromName = $data['display']['op_title'];
	    $mail->From = $data['display']['pm_email'];
	    $mail->Host = $GLOBALS['cfg']->get('smtp','Host');
	    $mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
	    if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
	        $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
	        $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
	    }
	    $mail->AddAddress($data['display']['pm_email']);
	    $mail->Subject  = "Bestellung bei " . $data['display']['op_title'];
	    $mail->Body  = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'mail/order.tpl');
	    if(!$mail->Send()){
	        XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
	    }
	    
	    XT::query("
        INSERT into
            " . $GLOBALS['plugin']->getTable('microshop_order_history') . "
        SET
            display_id = '" . $display_id . "',
            order_date = '" . time() . "',
            order_sum = '" . $sum . "',
            ordered_items = '" . serialize($data['products']) . "',
            address = '" . serialize($data['formvalues']['address']) . "',
            email = '" . $data['formvalues']['address']['email'] . "'  
    	",__FILE__,__LINE__);
	    
	    $current_page++;
	}
}
elseif(XT::getValue("change"))
{
	Header( "Location: /index.php?TPL=10091&x9200_page=3" ); 
}

XT::assign("CURRENTPAGE", $current_page);
$res = XT::query("SELECT * from " . XT::getTable("microshop_pages") . " WHERE display_id={$display_id} AND position={$current_page} AND active = 1",__FILE__,__LINE__);
while($row = $res->FetchRow()){
	$data['page'] = $row;
}
switch ($data['page']['type']) {
	case 0:
		include 'type0.php'; // Textpage
		break;
	case 1:
		include 'type1.php'; // Productpage
		break;
}