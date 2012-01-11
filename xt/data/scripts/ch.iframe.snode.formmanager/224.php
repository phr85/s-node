<?php
if($_SESSION['captcha'] != md5(strtoupper($_REQUEST['captcha']))) {
    $error .= XT::translate('False captcha code');
}
?>