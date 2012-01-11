<?php
// read the post from PayPal system and add 'cmd'

$req = 'cmd=_notify-synch';

$tx_token = $_REQUEST['tx'];
$auth_token = "CGLx_j6BLXuU04aoy7em56ipIgi4g2GrvUYAYIgPhHiFOVLKtPAARi8ETCq";
$req .= "&tx=$tx_token&at=$auth_token";

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);
// If possible, securely post back to paypal using HTTPS
// Your PHP server will need to be SSL enabled
// $fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

if (!$fp) {
    // HTTP ERROR
    echo "fsock failed";
} else {
    fputs ($fp, $header . $req);
    // read the body data
    $res = '';
    $headerdone = false;
    while (!feof($fp)) {
        $line = fgets ($fp, 1024);
        if (strcmp($line, "\r\n") == 0) {
            // read the header
            $headerdone = true;
        }
        else if ($headerdone)
        {
            // header has been read. now read the contents
            $res .= $line;
        }
    }
    XT::setSessionValue('payment',0);
    // parse the data
    $lines = explode("\n", $res);
    $keyarray = array();
    if (strcmp ($lines[0], "SUCCESS") == 0) {
        for ($i=1; $i<count($lines);$i++){
            list($key,$val) = explode("=", $lines[$i]);
            $keyarray[urldecode($key)] = urldecode($val);
        }
        // check the payment_status is Completed
        if(XT::getSessionValue('txn_id')!= $keyarray['txn_id']){
            XT::setSessionValue('payment',1);
        }else{
            XT::setSessionValue('payment',0);
        }
        // check that txn_id has not been previously processed
        XT::setSessionValue('txn_id', $keyarray['txn_id']);
        // check that receiver_email is your Primary PayPal email
        if($keyarray['receiver_email'] != getConfigValue('paypal_account')){
            XT::setSessionValue('payment',0);
        }
        // check that payment_amount/payment_currency are correct
        
        // process payment
           XT::setValue('action',"orderOk");
    }
    else if (strcmp ($lines[0], "FAIL") == 0) {
        // log for manual investigation
    }
    
}
XT::assign('PAYMENT_DONE', XT::getSessionValue('payment'));
echo XT::getSessionValue('payment');
fclose ($fp);

?>