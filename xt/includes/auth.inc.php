<?php

// include authentication class
require_once(CLASS_DIR . 'auth/auth.' . $GLOBALS['cfg']->get("auth", "mode") . '.class.php');

// Internet Explorer Fix
session_cache_limiter('no_cache');

// Start session
if(intval($GLOBALS['cfg']->get("system", "session_life_time")) > 0) {
    ini_set("session.gc_maxlifetime", intval($GLOBALS['cfg']->get("system", "session_life_time")));
}
session_start();

// Avoid session hijacking
if(!isset($_SESSION['user']['addr']) || empty($_SESSION['user']['addr'])){
    $_SESSION['user']['addr'] = $_SERVER['REMOTE_ADDR'];
} elseif ($_SESSION['user']['addr'] != $_SERVER['REMOTE_ADDR']){
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    die();
}

// Logout procedure
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    die();
}

// Create new authentication object
global $auth;
$GLOBALS['auth'] = new XT_Auth();

// Login (performs login, if required vars are set)
$GLOBALS['auth']->login();

// Init arrays
if(!is_array($_SESSION['user'])){
    $_SESSION['user'] = array();
}
if(!array_key_exists('roles',$_SESSION['user'])){
    $_SESSION['user']['roles'] = array();
}

// Add each user to "Everyone" Role
if(!in_array(3,$_SESSION['user']['roles'])){
    $_SESSION['user']['roles'][] = 3;
}

// Add each logged in user to "User" Role
if($GLOBALS['auth']->isAuth()){
    if(!in_array(2,$_SESSION['user']['roles'])){
        $_SESSION['user']['roles'][] = 2;
    }
}

?>