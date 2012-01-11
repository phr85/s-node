<?php

foreach (glob(ROOT_DIR . "templates_c/*.php") as $filename) {
   unlink($filename);
}

?>