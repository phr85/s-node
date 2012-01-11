<?php
// Get user id
$result = XT::query("SELECT id FROM xt_user WHERE username = '" . $fields['username'] . "'",__FILE__,__LINE,0);
$data = XT::getQueryData($result);
$user_id = $data[0]['id'];


if($user_id > 0){
    $error= XT::translate('user exists');
}
?> 