<?php
$GLOBALS['plugin']->per_page = $GLOBALS['plugin']->getConfig('pagesplit');
XT::enableLiveNavigator('guestbook');

// Buttons
XT::addButton("Add entry", "add");


// SQL
$result = XT::query("SELECT id, creation_date, name, email, website, comment FROM " . $GLOBALS['plugin']->getTable("guestbook") . " ORDER BY id DESC LIMIT " . $GLOBALS['plugin']->getLimiter(),__FILE__,__LINE__);

XT::assign("EMOTICONS", $GLOBALS['plugin']->getConfig('emoticons'));
XT::assign("EMOTICONLIST", $GLOBALS['plugin']->getConfig('emoticonlist'));
XT::assign("BADWORDS", $GLOBALS['plugin']->getConfig('badwords'));
XT::assign("BADWORDREPLACE", $GLOBALS['plugin']->getConfig('badwordreplace'));
XT::assign("BADWORDLIST", $GLOBALS['plugin']->getConfig('badwordlist'));
XT::assign("DATA", XT::getQueryData($result));
XT::assign("TPL", 500);

$content = XT::build("list.tpl");

?>