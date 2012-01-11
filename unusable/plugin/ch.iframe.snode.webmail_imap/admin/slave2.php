<?php
XT::unsetSessionValue('tree_id');

$result = XT::query("
    SELECT
        id,
        mail_adress
    FROM
        " . XT::getTable("mail_accounts") . "
",__FILE__,__LINE__);

$accounts = array();

while ($row = $result->fetchRow()) {
	$accounts[] = $row;
}

if (XT::getValue("account_id") != "") {
	XT::setSessionValue("account_id", XT::getValue("account_id"));
}

$account_id = XT::getSessionValue("account_id") == "" ? $accounts[0]['id'] : XT::getSessionValue("account_id");

if (XT::getSessionValue("account_id") == "") {
	XT::setSessionValue("account_id", $account_id);
}

if($GLOBALS['plugin']->getSessionValue("tree_id") != ''){
    $active = $GLOBALS['plugin']->getSessionValue("tree_id");
}else{
    // Get active folder
    $result = XT::query("
    SELECT
        id,
        tree_id,
        title,
        level,
        floor((r-l-1)/2) as subs
    FROM
        " .  XT::getTable('mail_folders') . "
    WHERE
        account_id = " . $account_id . "
    AND
        pid = 0 
        ",__FILE__,__LINE__,0);

    $data = array();
    if($row = $result->FetchRow()){
        $active = $row['tree_id'];
    }
}

if($GLOBALS['plugin']->getValue('tree_id') != ''){
    $active = $GLOBALS['plugin']->getValue('tree_id');
}
$GLOBALS['plugin']->setSessionValue("tree_id", $active);


require_once(CLASS_DIR . "widgets/one_table_tree.widget.class.php");
$treewidget = new XT_WidgetTreeWithTreeId;
$treewidget->addDetails('title');
$count = $treewidget->buildTree('mail_folders','mail_folders','%s',$in);

/**
 * fetch content
 */
XT::assign("ACCOUNTS", $accounts);
$content = XT::build('slave2.tpl');

?>