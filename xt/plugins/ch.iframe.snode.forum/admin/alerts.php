<?php

// alerts
$result = XT::query("SELECT p.*,u.username   from " . XT::getTable("forum_postings_alerts") . " as p 
LEFT JOIN 
" . XT::getTable("user") . " as u on (u.id = p.user)
WHERE
p.id =" . XT::getValue('id') . "
",__FILE__,__LINE__,0);
$data['alerts']=XT::getQueryData($result);

XT::assign("DATA",$data);

// posting
$result = XT::query("SELECT p.*,u.username  from " . XT::getTable("forum_postings") . "  as p
LEFT JOIN 
 " . XT::getTable("user") . " as u on (u.id = p.creation_user)
 WHERE
p.id =" . XT::getValue('id') . "
",__FILE__,__LINE__,0);
$post=XT::getQueryData($result);

XT::assign("POST",$post[0]);
XT::assign('ID',XT::getValue('id'));
$content = XT::build("alerts.tpl");

?>
