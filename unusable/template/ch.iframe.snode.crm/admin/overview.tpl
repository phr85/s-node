<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
{include file="includes/buttons.tpl" data=$BUTTONS}
</form>
<div style="width: 33%; float: left;">{plugin package="ch.iframe.snode.crm" module="box_search" priority="1"}</div>
<div style="width: 33%; float: left;">{plugin package="ch.iframe.snode.crm" module="box_contacts" priority="1"}</div>
<div style="width: 33%; float: left;">{plugin package="ch.iframe.snode.crm" module="box_contacts" priority="1"}</div>