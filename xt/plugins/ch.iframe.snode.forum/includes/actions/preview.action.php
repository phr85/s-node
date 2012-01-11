<?php

// load abbc class
XT::loadClass("abbc/abbc.lib.php");
XT::assign("PREVIEW", abbc_proc(stripslashes(XT::getValue('body'))));

XT::call("saveUploadedFileTemporary");

?>