<?php
// Ensure that the data array is empty
$data = array();

// Enable the navigator
XT::enableLiveNavigator('','','select count(id) as count_id from ' . XT::getTable('guestbook') . ' where active=1');// Buttons


// SQL
$result = XT::query("SELECT id, creation_date, name, email, website, comment FROM " . XT::getTable("guestbook") . " WHERE active=1 ORDER BY id DESC LIMIT " . $GLOBALS['plugin']->getLimiter(),__FILE__,__LINE__);
$data['data'] = XT::getQueryData($result);

$data['emoticons'] = XT::getConfig('emoticons');
$data['emoticonlist'] = XT::getConfig('emoticonlist');
$data['badwords'] = XT::getConfig('badwords');
$data['badwordreplace'] = XT::getConfig('badwordreplace');
$data['badwordlist'] = XT::getConfig('badwordlist');

XT::assign("xt" . XT::getBaseID() . "_list", $data);
 
// Fetch content
if(XT::getParam("style") != ""){
    $style = XT::getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);
?>