<form name="addresslist" id="addresslist" method="POST" action="{$smarty.server.SCRIPT_NAME}?TPL={$TPL}">
<table  width="400">
	<tr>
		<td><b>{"title"|translate}</b></td>
		<td width="100"><b>{"actions"|translate}</b></td>
	</tr>
	{foreach from=$xt7400_user_list.data item=ADDRESS}
	<tr >
		<td class="addresslist">{$ADDRESS.title}</td>
		<td class="addresslist">
		{if $xt7400_user_list.mode == "admin"}
		{
   	   actionIcon
       action="userdel"
       icon="delete.png"
       form="addresslist"
       title="Delete address"
       ask="Are you sure, you want to delete this address?"
       id=$ADDRESS.id
   		}
   		{if $ADDRESS.active == 1}
   		{
   	   actionIcon
       action="deactivateAddress"
       icon="active.png"
       form="addresslist"
       title="Deactivate address"
       id=$ADDRESS.id
   		}
   		{else}{
   	   actionIcon
       action="activateAddress"
       icon="inactive.png"
       form="addresslist"
       title="Deactivate address"
       id=$ADDRESS.id
   		}
   		{/if}
   		{/if}
   		
   		{if $xt7400_user_list.mode == "user"}
   			{if $xt7400_user_list.data|@count > 1}
   				{
		   	   actionIcon
		       action="deactivateAddress"
		       icon="delete.png"
		       form="addresslist"
		       title="Delete address"
		       ask="Are you sure, you want to delete this address?"
		       id=$ADDRESS.id
   		}
   			{/if}
   		{/if}
   		<a href="{$smarty.server.SCRIPT_NAME}?TPL={$xt7400_user_list.edit_tpl}&amp;x{$BASEID}_id={$ADDRESS.id}"><img src="{$XT_IMAGES}icons/pencil.png" alt="{"edit address"|translate}"/></a>
	</tr>
	{/foreach}
</table>
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />
</form>