<?php

// alerts
$result = XT::query("SELECT p.*, count(a.id) as alerts from " . XT::getTable("forum_postings") . " as p
INNER JOIN " . XT::getTable("forum_postings_alerts") . " as a on (a.id = p.id)
group by p.id order by alerts desc",__FILE__,__LINE__);
$data['alerts']=XT::getQueryData($result);

// Themes
$result = XT::query("SELECT * from " . XT::getTable("forum_postings") . " where pid=0  order by creation_date desc limit 0, 10",__FILE__,__LINE__);
$data['themes']=XT::getQueryData($result);

// postings
$result = XT::query("SELECT top.title as toptit ,post.*  from " . XT::getTable("forum_postings") . " as post  
left JOIN " . XT::getTable("forum_postings") . " as top on(top.topic_id = post.topic_id AND top.level=1) 
WHERE post.active=1
order by post.l asc limit 0, 10",__FILE__,__LINE__);
$data['postings']=XT::getQueryData($result);

// inactive postings
$result = XT::query("SELECT * from " . XT::getTable("forum_postings") . " where active = 0 order by creation_date desc",__FILE__,__LINE__);
$data['inactivepostings']=XT::getQueryData($result);

XT::assign("DATA",$data);

$content = XT::build("slave1.tpl");

?>
