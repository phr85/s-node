<div style="padding:5px;">
<form method="post" name="slave1" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<fieldset>
<legend>{"alerts"|translate}</legend>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
{foreach from=$DATA.alerts item=ALERT}
<tr>
<td class="row" width="65"><b>{$ALERT.alerts}</b><br />
{actionIcon action="deleteThread" perm="moderate" icon="delete.png" thread_id=$ALERT.id form="0" topic_id=$ALERT.topic_id title="delete"}{if $ALERT.active}{actionIcon action="disableThread" perm="moderate" icon="active.png" thread_id=$ALERT.id form="0" topic_id=$ALERT.topic_id title="deactivate"}{else}{actionIcon action="enableThread" perm="moderate" icon="inactive.png" thread_id=$ALERT.id form="0" topic_id=$ALERT.topic_id title="activate"}{/if}</td>
<td class="row" width="150">{actionLink action="showAlerts" target="slave1" form=0 id=$ALERT.id text=$ALERT.title}</td>
<td class="row">User: {$ALERT.creation_user}</td>
<td class="row">{$ALERT.creation_date|date_format}</td>
<td class="row">id{$ALERT.id}-lvl{$ALERT.level}</td>
</tr>
{/foreach}
</table>
</fieldset>

<fieldset>
<legend>{"postings"|translate}</legend>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
{foreach from=$DATA.postings item=POSTING}
<tr>
<td class="row" width="65">{actionIcon action="deleteThread" perm="moderate" icon="delete.png" thread_id=$POSTING.id form="0" topic_id=$POSTING.topic_id title="delete"}{if $POSTING.active}{actionIcon action="disableThread" perm="moderate" icon="active.png" thread_id=$POSTING.id form="0" topic_id=$POSTING.topic_id title="deactivate"}{else}{actionIcon action="enableThread" perm="moderate" icon="inactive.png" thread_id=$POSTING.id form="0" topic_id=$POSTING.topic_id title="activate"}{/if}{if $POSTING.bad_level > 0}<img src="/images/icons/forbidden_small.png" alt="$POSTING.bad_level" />{/if}</td>
<td class="row" width="150"><span title="{$POSTING.toptit}">{$POSTING.title}</span></td>
<td class="row">User: {$POSTING.creation_user}</td>
<td class="row">{$POSTING.creation_date|date_format}</td>
<td class="row">id{$POSTING.id}-lvl{$POSTING.level}</td>
</tr>
{/foreach}
</table>
</fieldset>

<fieldset>
<legend>{"inactivepostings"|translate}</legend>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
{foreach from=$DATA.inactivepostings item=INACTIVEPOSTING}
<tr>
<td class="row" width="65">{actionIcon action="deleteThread" perm="moderate" icon="delete.png" thread_id=$INACTIVEPOSTING.id form="0" topic_id=$INACTIVEPOSTING.topic_id title="delete"}{if $INACTIVEPOSTING.active}{actionIcon action="disableThread" perm="moderate" icon="active.png" thread_id=$INACTIVEPOSTING.id form="0" topic_id=$INACTIVEPOSTING.topic_id title="deactivate"}{else}{actionIcon action="enableThread" perm="moderate" icon="inactive.png" thread_id=$INACTIVEPOSTING.id form="0" topic_id=$INACTIVEPOSTING.topic_id title="activate"}{/if}{if $INACTIVEPOSTING.bad_level > 0}<img src="/images/icons/forbidden_small.png" alt="$INACTIVEPOSTING.bad_level" />{/if}</td>
<td class="row" width="150">{$INACTIVEPOSTING.title}</td>
<td class="row">User: {$INACTIVEPOSTING.creation_user}</td>
<td class="row">{$INACTIVEPOSTING.creation_date|date_format}</td>
<td class="row">id{$INACTIVEPOSTING.id}-lvl{$INACTIVEPOSTING.level}</td>
</tr>
{/foreach}
</table>
</fieldset>

<fieldset>
<legend>{"themes"|translate}</legend>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
{foreach from=$DATA.themes item=THEMES}
<tr>
<td class="row" width="65">{actionIcon action="deleteThread" perm="moderate" icon="delete.png" thread_id=$THEMES.id form="0" topic_id=$THEMES.topic_id title="delete"}{if $THEMES.active}{actionIcon action="disableThread" perm="moderate" icon="active.png" thread_id=$THEMES.id form="0" topic_id=$THEMES.topic_id title="deactivate"}{else}{actionIcon action="enableThread" perm="moderate" icon="inactive.png" thread_id=$THEMES.id form="0" topic_id=$THEMES.topic_id title="activate"}{/if}{if $THEMES.bad_level > 0}<img src="/images/icons/forbidden_small.png" alt="$THEMES.bad_level" />{/if}</td>
<td class="row" width="150">{$THEMES.title}</td>
<td class="row">User: {$THEMES.creation_user}</td>
<td class="row">{$THEMES.creation_date|date_format}</td>
<td class="row">id{$THEMES.id}-lvl{$THEMES.level}</td>
</tr>
{/foreach}
</table>
</fieldset>

 


{include file="ch.iframe.snode.forum/admin/hiddenValues.tpl"}

</form>
</div>
