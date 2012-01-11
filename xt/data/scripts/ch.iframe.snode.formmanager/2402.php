<?php
// Set Pool id
$poolID = 4;


// Create user
XT::query("
    INSERT INTO
        xt_user
    (
        username,
        password,
        creation_date,
        creation_user,
        active
    ) VALUES (
        '" . $fields['username'] . "',
        '" . md5($fields['pw1'] . $GLOBALS['cfg']->get("system","magic")) . "',
        " . time() . ",
        '" . XT::getUserID() . "',
        1
    )",__FILE__,__LINE__);

// Get user id
$result = XT::query("SELECT id FROM xt_user ORDER BY id DESC LIMIT 1");
$data = XT::getQueryData($result);
$user_id = $data[0]['id'];

// Create a customer
XT::query("
    INSERT INTO
        xt_addresses
    (
        title,
        firstName,
        lastName,
        email,
        country,
        user_id
    ) VALUES (
        '" . $fields['vorname'] . " " . $fields['nachname'] ."',
        '" . $fields['vorname'] . "',
        '" . $fields['nachname'] . "',
        '" . $fields['mail'] . "',
        '" . $fields['country'] . "',
        " . $user_id . "
    )
",__FILE__,__LINE__);


// Add to pool
XT::query("INSERT
   INTO xt_security_pools_rel
       (node_id, principal_id, principal_type)
    VALUES
        ($poolID, " . $user_id . ",  1)
     ",__FILE__,__LINE__);


//login
$GLOBALS['auth']->setCredentials($fields['username'],$fields['pw1']);
$GLOBALS['auth']->login();

?> 