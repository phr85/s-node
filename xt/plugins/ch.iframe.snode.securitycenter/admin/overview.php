<?php



function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title');
$count = $treewidget->buildTree('pools','pools_details','%s','sys');
$in = implode(",", $treewidget->way);

XT::assign("CTRL", $GLOBALS['plugin']->getSessionValue('ctrl_add') | $GLOBALS['plugin']->getSessionValue('ctrl_cut') | $GLOBALS['plugin']->getSessionValue('ctrl_copy'));
// Get roles for open
$result = XT::query("
    SELECT
        b.title,
        b.id,
        a.node_id
    FROM
        " . $GLOBALS['plugin']->getTable("pools_rel") . " as a LEFT JOIN
        " . $GLOBALS['plugin']->getTable("roles") . " as b ON (b.id = a.principal_id)
    WHERE
        a.principal_type = 3
        AND a.node_id IN (" . $in . ")
    GROUP by b.id
",__FILE__,__LINE__);

$roles = array();
while($row = $result->FetchRow()){
    $roles[$row['node_id']][] = $row;
    if($GLOBALS['plugin']->getValue("principal_id") == $row['id'] && $GLOBALS['plugin']->getValue("principal_type") == 3){
        $GLOBALS['plugin']->setSessionValue('role_id',$row['id']);
        // groups in roles
        $subresult = XT::query("
                SELECT
                    b.title,
                    b.id,
                    a.role_id
                FROM
                    " . $GLOBALS['plugin']->getTable("group_roles") . " as a LEFT JOIN
                    " . $GLOBALS['plugin']->getTable("groups") . " as b ON (b.id = a.group_id)
                WHERE
                    a.role_id = " . $row['id'] . "
                GROUP by b.id"
        ,__FILE__,__LINE__,0);

        $groups_in_roles = array();
        while($subrow = $subresult->FetchRow()){
            $groups_in_roles[] = $subrow;
            if($GLOBALS['plugin']->getValue("group_id") == $subrow['id'] && $GLOBALS['plugin']->getValue("principal_type") == 3){
                $GLOBALS['plugin']->setSessionValue('group_id',$subrow['id']);
            }
        }

    }
}

XT::assign("ROLES",$roles);
XT::assign("GROUPSINROLES",$groups_in_roles);


// Get groups for open
$result = XT::query("
    SELECT
        b.title,
        b.id,
        a.node_id
    FROM
        " . $GLOBALS['plugin']->getTable("pools_rel") . " as a LEFT JOIN
        " . $GLOBALS['plugin']->getTable("groups") . " as b ON (b.id = a.principal_id)
    WHERE
        a.principal_type = 2
        AND a.node_id IN (" . $in . ")
    GROUP by b.id
",__FILE__,__LINE__,0);

$groups = array();
while($row = $result->FetchRow()){
    $groups[$row['node_id']][] = $row;
    if($GLOBALS['plugin']->getValue("principal_id") == $row['id'] && $GLOBALS['plugin']->getValue("principal_type") == 2){
        $GLOBALS['plugin']->setSessionValue('group_id',$row['id']);
    }
}

XT::assign("GROUPS",$groups);

XT::assign("PRINCIPAL_ID",$GLOBALS['plugin']->getValue('principal_id'));
XT::assign("GROUP_ID",$GLOBALS['plugin']->getValue('group_id'));
XT::assign("PRINCIPAL_TYPE",$GLOBALS['plugin']->getValue('principal_type'));

// Define ctrl mode
XT::assign("OPEN", $GLOBALS['plugin']->getSessionValue('open'));
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build('overview.tpl');

?>
