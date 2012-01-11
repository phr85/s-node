<div style="padding:5px;">
<h1 class="title">{$POST.title}&nbsp;</h1>{$POST.topic_id}
<hr />
{$POST.body}
<hr />
user: {$POST.username} date:{$POST.creation_date|date_format}
<br />
<br />
<form method="post" name="slave1" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">

<fieldset>
<legend>{"alerts"|translate}</legend>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
{foreach from=$DATA.alerts item=ALERT}
<tr>
<td class="row" width="65"><b>{$ALERT.alerts}</b><br />
{actionIcon action="deleteAlert" icon="delete.png" alert_id=$ALERT.id form="0" title="delete"}
</td>
<td class="row" width="150">{$ALERT.message}</td>
<td class="row">User: {$ALERT.username}</td>
<td class="row">{$ALERT.date|date_format}</td>

</tr>
{/foreach}
</table>
</fieldset>



{include file="ch.iframe.snode.forum/admin/hiddenValues.tpl"}

</form>
</div>
