<?php
if(XT::getParam('display')=='slave'){
    include('slave.php');
}else {
    include('master.php');
}
?>