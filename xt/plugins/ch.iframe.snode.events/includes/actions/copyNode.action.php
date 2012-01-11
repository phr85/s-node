<?php
$node_id = XT::getValue("source_node_id") == "" ? 0 : XT::getValue("source_node_id");
XT::setSessionValue("source_node_id", $node_id);
XT::setSessionValue("ctrl_copy", 1);
?>