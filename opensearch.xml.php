<?php
require_once('xt/includes/config.inc.php');
header('content-type: text/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8" ?>';
?>
<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/">
<ShortName><? echo $GLOBALS['cfg']->get("system","base_meta_title"); ?></ShortName>
<Description><? echo $GLOBALS['cfg']->get("system","base_meta_description"); ?></Description>
<InputEncoding>UTF-8</InputEncoding>
<Image width="16" height="16">http://<? echo $_SERVER['HTTP_HOST']; ?>/favicon.ico</Image>
<Url type="text/html" template="http://<? echo $_SERVER['HTTP_HOST']; ?>/index.php?TPL=10028&amp;x80_term={searchTerms}"/>
</OpenSearchDescription>