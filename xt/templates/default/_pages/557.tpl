{include file="includes/header/header_admin_empty.tpl"}
{get_getvalue param="conf" assign="conf"}


{plugin package="ch.iframe.snode.category" module="_univeralpickerTreeNode" 
table_tree=$conf.table_tree
table_nodes=$conf.table_nodes
table_items=$conf.table_items
table_items_relation=$conf.table_items_relation
tree_ctype=$conf.tree_ctype
item_ctype=$conf.item_ctype
itemrelfieldname=$conf.itemrelfieldname
noderelfieldname=$conf.noderelfieldname

}

{include file="includes/footer/footer_admin_empty.tpl"}