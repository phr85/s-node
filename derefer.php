<?php

$url = $_GET['url'];
if (strpos($url, '://') === false) $url = 'http://' . $url;

header("Location: " . $url);
?>
