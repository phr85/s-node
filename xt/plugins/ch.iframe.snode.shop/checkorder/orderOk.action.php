<?php
    XT::assign("ABHOLUNG",XT::getValue('abholung'));
    XT::assign("ABHOLDATUM",XT::getValue('abholdatum_str'));

    XT::assign("LIEFERUNG",XT::getValue('lieferung'));
    XT::assign("LIEFERDATUM",XT::getValue('lieferdatum_str'));



$product_count = 0;
foreach($_SESSION['BASKET'] as $product_id => $value){
    $product_count += $value['quantity'];
    $in .= ', ' . $product_id;
}

if($product_count > 0){

    // Insert order
    XT::query("
        INSERT INTO
            " . $GLOBALS['plugin']->getTable("orders") . "
        (
            user_id,
            session_id,
            creation_date,
            transport,
            discount,
            totalprice,
            endprice,
            taxes,
            gifts,
            products,
            products_count,
            shipping_addr,
            billing_addr
        ) VALUES (
            " . XT::getUserID() . ",
            '" . session_id() . "',
            " . time() . ",
            '" . $_SESSION['ORDER']['transport'] . "',
            '" . $_SESSION['ORDER']['discount'] . "',
            '" . $_SESSION['ORDER']['totalprice'] . "',
            '" . $_SESSION['ORDER']['endprice'] . "',
            '" . $_SESSION['ORDER']['taxes'] . "',
            '" . count(@$_SESSION['GIFT']['selected']) . "',
            '" . count(@$_SESSION['BASKET']) . "',
            '" . $product_count . "',
            " . XT::getSessionValue('shipping_address') . ",
            " . XT::getSessionValue('billing_address') . "
        )
    ",__FILE__,__LINE__);

    // Get order id
    $result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable("orders") . " ORDER BY id DESC LIMIT 1",__FILE__,__LINE__);

    $order_id = 0;
    while($row = $result->FetchRow()){
        $order_id = $row['id'];
    }

    foreach($_SESSION['BASKET'] as $product_id => $value){

        // Insert order position
        XT::query("
            INSERT INTO
                " . $GLOBALS['plugin']->getTable("orders_details") . "
            (
                order_id,
                product_id,
                quantity,
                price
            ) VALUES (
                " . $order_id . ",
                " . $product_id . ",
                '" . $value['quantity'] . "',
                '" . $value['price'] . "'
            )
        ",__FILE__,__LINE__);
        // bestand anpassen
        XT::query("UPDATE " . XT::getTable("catalog_articles") . " set stock=(stock - " . $value['quantity'] . ") where id = " . $product_id,__FILE__,__LINE__);
    }



    if(is_array(@$_SESSION['GIFT']['selected'])){
        foreach($_SESSION['GIFT']['selected'] as $product_id => $value){

            $in .= ', ' . $product_id;

            // Insert order position
            XT::query("
                INSERT INTO
                    " . $GLOBALS['plugin']->getTable("orders_details") . "
                (
                    order_id,
                    product_id,
                    quantity,
                    price
                ) VALUES (
                    " . $order_id . ",
                    " . $value['id'] . ",
                    1,
                    0
                )
            ",__FILE__,__LINE__);
        }
    }


    // Get product information
    $in = substr($in,1);
    $result = XT::query("SELECT
                a.title,
                a.id,
                p.price,
                c.art_nr
              FROM
                   " . $GLOBALS['plugin']->getTable('catalog_articles_details') . " as a
               LEFT JOIN
                   " . $GLOBALS['plugin']->getTable("price") . " as p ON (p.article_id = a.id),
                   " . $GLOBALS['plugin']->getTable('catalog_articles') . " as c
               WHERE
                   a.id in (" . $in . ") AND c.id = a.id
               AND
                   lang='" . $GLOBALS['plugin']->getActiveLang() . "'"
    ,__FILE__,__LINE__,0);

    $data = array();
    while($row = $result->FetchRow()){
        $row['single_price'] = $row['price'];
        $row['quantity'] = $_SESSION['BASKET'][$row['id']]['quantity'];
        $row['total_price'] = $row['price'] * $_SESSION['BASKET'][$row['id']]['quantity'];
        $data[] = $row;
    }


    // Geschenke
    XT::assign("SELECTEDGIFTS", $_SESSION['GIFT']['selected']);
    XT::assign("DISPLAYGIFT", count($_SESSION['GIFT']['selected']) > 0 ? true : false);

    // Set variables
 
    //Warenkorb
    include(PLUGIN_DIR . "ch.iframe.snode.shop/includes/shared/basket.php");
    // Geschenke
    include(PLUGIN_DIR . "ch.iframe.snode.shop/includes/shared/gift.php");
 
    XT::assign("DISCOUNT", $_SESSION['ORDER']['discount']);
    XT::assign("TRANSPORT", $_SESSION['ORDER']['transport']);
    XT::assign("TOTALPRICE",$_SESSION['ORDER']['totalprice']);
    XT::assign("ORDER_NR", $order_id);
    XT::assign("ORDER_TIME", time());
    XT::assign("ENDPRICE", $_SESSION['ORDER']['endprice']);
    XT::assign("USERNAME", XT::getUserName());

    $total_tmp = $_SESSION['ORDER']['endprice'];
    XT::assign("TAXES", $total_tmp - ($total_tmp / (100 + $GLOBALS['plugin']->getConfig("taxvalue")) * 100));

    // Send confirmation mail
    require_once(CLASS_DIR . 'mail.class.php');
    $mail = new XT_Mail(XT::getConfig('shopadmin'),XT::getConfig('shopadmin_name'),XT::getConfig('shopadmin_replyAddr'));
    $mail->addReceiver($address['billing'][0]['email'],$address['billing'][0]['firstName'] . ' ' . $address['billing'][0]['lastName']);
    $mail->setSubject($GLOBALS['lang']->msg("Confirmation for your order") . ' (#' . $order_id . ')');

        //$mail->setHTML(true);
        $mail->setBody($GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'mail_external.tpl'));
        $mail->setPlainBody(strip_tags($GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'mail_external.tpl')));
        $mail->send();


    // Internal Mail
    $mail = new XT_Mail(XT::getConfig('shopadmin'),XT::getConfig('shopadmin_name'),$address['billing'][0]['email']);
    $mail->addReceiver(XT::getConfig('shopoperator'),XT::getConfig('shopoperator_name'));
    $mail->setHTML(true);
    $mail->setSubject('SHOP - ' . $GLOBALS['lang']->msg("New order") . ' (#' . $order_id . ')');
    $mail->setBody($GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'mail_internal.tpl'));
    $mail->setPlainBody(strip_tags($GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'mail_external.tpl')));
    $mail->send();

    unset($_SESSION['GIFT']);
    unset($_SESSION['BASKET']);

    $GLOBALS['plugin']->setSessionValue('OPSTEP',4);
    $op  = $GLOBALS['plugin']->getConfig("orderprocess");
    header("Location:" . $_SERVER['PHP_SELF'] . "?TPL=" . $op[4]['tpl'] . "&x" . $GLOBALS['plugin']->getBaseID() . "_order_id=" . $order_id);
} else {

    $GLOBALS['plugin']->setSessionValue('OPSTEP',1);
    $op  = $GLOBALS['plugin']->getConfig("orderprocess");
    header("Location:" . $_SERVER['PHP_SELF'] . "?TPL=" . $op[1]['tpl']);
}

?>