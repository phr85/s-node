<?php
    // Adresse holen und zuordnern
    $sql = "SELECT * FROM xt_addresses WHERE user_id =" . $_SESSION['user']['id'];
    $result = XT::query($sql,__FILE__,__LINE__,0);
    $address = XT::getQueryData($result);
    $_SESSION['shop']['address'] = $address[0];

?>