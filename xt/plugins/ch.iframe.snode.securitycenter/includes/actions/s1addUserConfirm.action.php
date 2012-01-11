<?php
/**
 * Adds a user
 */

$password = "";
if(($GLOBALS['plugin']->getPostValue('password') != $GLOBALS['plugin']->getPostValue('password_confirm'))){
    XT::log("Your passwords are not identical",__FILE__,__LINE__,XT_ERROR);
} else {
    if($GLOBALS['plugin']->getPostValue('password') != '' && $GLOBALS['plugin']->getPostValue('password_confirm') != ''){
        $password = md5($GLOBALS['plugin']->getPostValue('password') . $GLOBALS['cfg']->get("system","magic"));
    }
}
if($GLOBALS['plugin']->getPostValue('password') == ""){
    XT::log("Password cannot be empty",__FILE__,__LINE__,XT_ERROR);
}

if($GLOBALS['plugin']->getPostValue('username') == ""){
    XT::log("Username cannot be empty",__FILE__,__LINE__,XT_ERROR);
}

if($GLOBALS['plugin']->getPostValue('email') == ""){
    XT::log("E-Mail address cannot be empty",__FILE__,__LINE__,XT_ERROR);
}

// Check for already existing username
$result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable('users') . " WHERE username = '" . $GLOBALS['plugin']->getPostValue('username') . "'",__FILE__,__LINE__);
while($row = $result->FetchRow()){
    XT::log("This username is already in use",__FILE__,__LINE__,XT_ERROR);
}
if(XT::hasErrors()){
    XT::actionStop("Errors");
}
// If there were no errors, go ahead an insert user into db
if(!XT::hasErrors()){

    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('users') . " (
        username,
        password,
        email,
        creation_date,
        creation_user,
        mod_date,
        mod_user
        ) VALUES (
        '" . $GLOBALS['plugin']->getPostValue('username') . "',
        '" . $password . "',
        '" . $GLOBALS['plugin']->getPostValue('email') . "',
        " . time() . ",
        " . $_SESSION['user']['id'] . ",
        " . time() . ",
        " . $_SESSION['user']['id'] . "
        )",__FILE__,__LINE__);

    $result = XT::query("SELECT id from " . $GLOBALS['plugin']->getTable('users') . " WHERE username='" . $GLOBALS['plugin']->getPostValue('username') . "'" ,__FILE__,__LINE__);
    while($row = $result->FetchRow()){
        $GLOBALS['plugin']->setValue('user_id', $row['id']);
        $GLOBALS['plugin']->setAdminModule('s1EditUser');

        // Create Address
        XT::loadClass('address.class.php','ch.iframe.snode.addressmanager');

		// Instantiate address entry
		$address = new XT_Address();
		// Update values
		$address->setTitle(XT::getValue('username'));
		$address->setImage($row['image']);
		$address->setEMail(XT::getValue('email'));
		$address->setDescription(XT::getValue('description'));
		$address->setuserid(XT::getValue('user_id'));
		$address->setPrimaryUserAddress(1);
		$address->setType(3);
		// Commit changes
		$address->save();




        if(is_array(XT::getValue('groups'))){
            foreach(XT::getValue('groups') as $group) {
                XT::query("DELETE
					   FROM
					       " . XT::getTable('user_groups') . "
					   WHERE
					       group_id= " . $group . "
					   AND
					       user_id= " . XT::getValue('user_id')
                ,__FILE__,__LINE__);
                XT::query("INSERT
					   INTO
					       " . XT::getTable('user_groups') . "
					       (user_id, group_id)
					    VALUES
					        (" . XT::getValue('user_id') . " ,
					         " . $group . "
					        )
					     ",__FILE__,__LINE__,0);
            }
        }
        if(is_array(XT::getValue('roles'))){
            foreach(XT::getValue('roles') as $role) {
                XT::query("DELETE
					   FROM
					       " . XT::getTable('user_roles') . "
					   WHERE
					       role_id= " . $role . "
					   AND
					       user_id= " . XT::getValue('user_id')
                ,__FILE__,__LINE__);
                XT::query("INSERT
					   INTO
					       " . XT::getTable('user_roles') . "
					       (user_id, role_id)
					    VALUES
					        (" . XT::getValue('user_id') . " ,
					         " . $role . "
					        )
					     ",__FILE__,__LINE__,0);
            }
        }
    }

}

?>