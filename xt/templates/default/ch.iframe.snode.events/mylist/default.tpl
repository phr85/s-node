<form name="EVENTlist" id="eventlist" method="POST" action="{$smarty.server.SCRIPT_NAME}?TPL={$TPL}">
<table  width="100%">
	<tr>
		<td><b>{"title"|translate}</b></td>
		<td><b>{"category"|translate}</b></td>
		<td><b>{"Date"|translate}</b></td>
		<td width="50"><b>{"actions"|translate}</b></td>
	</tr>
	{foreach from=$EVENTS item=EVENT}
	<tr >
		<td {if $EVENT.active == 1 }class="eventlist"{else}class="eventlist_inactive"{/if}>{$EVENT.title}</td>
		<td {if $EVENT.active == 1 }class="eventlist"{else}class="eventlist_inactive"{/if}>{$EVENT.cat}</td>
		<td {if $EVENT.active == 1 }class="eventlist"{else}class="eventlist_inactive"{/if}>{$EVENT.from_date|date_format:"%d.%m.%Y %H:%m"} ({$EVENT.duration} {$EVENT.duration_type|translate})</td>
		
		<td {if $EVENT.active == 1 }class="eventlist"{else}class="eventlist_inactive"{/if}>
	   {
   	   actionIcon
       action="userdel"
       icon="delete.png"
       form="eventlist"
       title="Delete event"
       ask="Are you sure, you want to delete this event?"
       id=$EVENT.id
   	   }
   	  <a href="{$smarty.server.SCRIPT_NAME}?TPL={$EDIT_TPL}&amp;x{$BASEID}_id={$EVENT.id}"><img src="{$XT_IMAGES}icons/pencil.png" alt="{"edit event"|translate}"/></a>
	</tr>
	{/foreach}
</table>
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />
</form>