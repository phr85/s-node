<?php
// Delete the timer session
$_SESSION['timer'] = array();
// Remove all comments
XT::setvalue('comment', false);
?>